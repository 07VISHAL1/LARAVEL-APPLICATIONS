<?php
namespace App\Services;
use Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class EmployeeListService
{
    /** 
    *  show the list of the employee 
    *  @param [type] $request 
    *  @return response
    */
    public function add($request)
    {
        try
        {  
            $draw 				= 	$request->get('draw');
            $start 				= 	$request->get("start"); 
            $rowPerPage 		= 	$request->get("length"); 
            $orderArray 	    = 	$request->get('order');
            $columnNameArray 	= 	$request->get('columns');                   
            $searchArray 		= 	$request->get('search');
            $columnIndex 		= 	$orderArray[0]['column'];
            $columnName 		= 	$columnNameArray[$columnIndex]['data']; 
            $columnSortOrder 	= 	$orderArray[0]['dir']; 
            $searchValue 		= 	$searchArray['value']; 
            $users              =   user::where('role_id','1');
            $total              =   $users->count();
            $totalFilter        = $users;
            if (!empty($searchValue))
            {
                $totalFilter = $totalFilter->where('name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();
            $arrData = $users;
            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);
            if (!empty($searchValue))
            {
                $arrData = $arrData->where('name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('email','like','%'.$searchValue.'%');
            }
            $arrData  = $arrData->get();
            $response = array(
                "draw"              => intval($draw),
                "recordsTotal"      => $total,
                "recordsFiltered"   => $totalFilter,
                "data" => $arrData,
            );
            return $response;      
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
}