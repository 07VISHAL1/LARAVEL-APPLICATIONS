<?php
namespace App\Services;
use Log;
use App\Models\Salary;
use App\Models\User;

class SalaryService
{
    /** 
	*  for adding the details of the employee salary
	*  @param data
    *  @return void
	*/
    public function add($request)
    {
        try
        {  
            $id= $request->employee_id;
            $salaryExixts = Salary::where('employee_id',$id)->first();
            if($salaryExixts)
                return null;
            else 
            if($role = salary::create([
                'employee_id'  => $request->input('employee_id'),
                'year'         => $request->input('year'),
                'amount'       => $request->input('amount'),
                'role_id'      => 1,
            ]))
                return true;
            else 
                return false;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }

    /** 
	*  for showing the dropdown in the view file  
	*  
    *  @return $user
	*/
    public function dropdown()
    {
        try
        {
            $user= User::where('role_id','1')->get();
            return $user;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }

    /** 
	*  for showing the details of the salary in the table format
	*  @param request
    *  @return void
	*/
    public function salarytable($request)
    {
        try
        {
            $draw 				= 		$request->get('draw');
            $start 				= 		$request->get("start");
            $rowPerPage 		= 		$request->get("length");
            $orderArray 	    = 		$request->get('order');
            $columnNameArray 	= 		$request->get('columns');                  
            $searchArray 		= 		$request->get('search');
            $columnIndex 		= 		$orderArray[0]['column'];
            $columnName 		= 		$columnNameArray[$columnIndex]['data']; 
            $columnSortOrder 	= 		$orderArray[0]['dir'];
            $searchValue 		= 		$searchArray['value']; 
            $users = user::join('salaries','users.id', '=', 'salaries.employee_id')
            ->where('salaries.role_id','1');
            $total = $users->count();
            $totalFilter = $users;
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
            $arrData = $arrData->get();
            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $arrData,
            );
            return $response;
        }
        catch (Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
    
    /** 
	*  for editing  the employee salary
	*  @param data
    *  @return void
	*/
    public function edit($id)
    {
        try
        {    
            $salaryExixts = User::join('salaries', 'users.id', 'salaries.employee_id')
            ->where('salaries.id', $id)
            ->first();
            if($salaryExixts)
                return $salaryExixts;
            else 
                return false;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
        
    /** 
	*  after editing and saving  the employee salary
	*  @param data
    *  @return void
	*/
    public function save($request)
    {
        try
        {    
            $id=$request->employee_id;
            $employee = salary::where('employee_id',$id)->first();
            $employee->employee_id   = $request->employee_id;
            $employee->year          = $request->year;
            $employee->amount        = $request->amount;
            if($employee->save())
                return $employee;
            else
                return false;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
}