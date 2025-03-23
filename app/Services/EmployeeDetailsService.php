<?php
namespace App\Services;
use Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InfoaddedByTheUser;
use App\Models\employee;
use App\Models\User;
use App\Models\EmployeeLeave;


class EmployeeDetailsService
{
    /** 
	* for adding the details of the employee
	*  
    *  @return void
	*/
    public function add($request)
    {
        try
        {  
            if($user                  = employee::create([
                'user_id'             => Auth()->user()->id,
                'phone_no'            => $request->input('phone_no'),
                'date_of_birth'       => $request->input('date_of_birth'),
                'date_of_joining'     =>  $request->input('date_of_joining'),
                'tax_regime'          => $request->input('tax_regime'),
                'emrgency_phone_no'   => $request->input('emrgency_phone_no'),
                'employee_code'       => $request->input('employee_code'),
            ]))
            {
                $user = User::where('role_id','2')->first();
                Notification::send($user ,new InfoaddedByTheUser);
                return true;
            }
            else 
                return false;
        }
        catch (Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }

    /** 
	*  for displaying the datatable of the employee
	*  @param [type] $request
    *  @return response
	*/
    public function show($request)
    {   
        try
        {  
            $draw                = $request->get('draw');
            $start               = $request->get("start");
            $rowPerPage          = $request->get("length");
            $orderArray          = $request->get('order');
            $columnNameArray     = $request->get('columns');
            $searchValue         = $request->get('search')['value'];
            $columnIndex         = $orderArray[0]['column'];
            $columnName          = $columnNameArray[$columnIndex]['data'];
            $columnSortOrder     = $orderArray[0]['dir'];
            $query               = employee::query();
            if (!empty($searchValue))
            {
                $query->where('phone_no', 'like', '%' . $searchValue . '%')
                ->orWhere('date_of_birth', 'like', '%' . $searchValue . '%');
            }
            $totalFilter = $query->count();
            $query->orderBy($columnName, $columnSortOrder);
            $query->skip($start)->take($rowPerPage);
            $arrData = $query->get();
            $response = array(
                "draw"              => intval($draw),
                "recordsTotal"      => employee::count(),
                "recordsFiltered"   => $totalFilter,
                "data" => $arrData,
            );
            return ($response); 
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
    
    /** 
	*  for updating the employee details 
	*  @param [type] $request ,$id
    *  @return response
	*/
    public function update($request)
    {
        try
        {  
            $id                      = Auth()->user()->id;
          
            $user                    = employee::where('user_id',$id)->first();
            $user->phone_no          = $request->input('phone_no');
            $user->date_of_birth     = $request->input('date_of_birth');
            $user->date_of_joining   = $request->input('date_of_joining');  
            $user->tax_regime        = $request->input('tax_regime');  
            $user->emrgency_phone_no = $request->input('emrgency_phone_no');  
            if($user->save())
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
	*  for checking whether  the employee details already exists
	* 
    *  @return $existingInfo
	*/
    public function employeeExist($id)
    {
        try
        {
            $existingInfo = Employee::where('user_id',$id)->first();
            return $existingInfo;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }

    }

    /** 
	*  for fetching only  the particular employee details
	* 
    *  @return $users
	*/

    public function editEmployee()
    {
        try
        {
            $data =Auth()->User()->id;
            $users= Employee::where('user_id',$data )->first();
            return $users;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
    public function leave($request)
    {
        try
        {
            if( $user = Employeeleave::create([
                'type'                =>  $request->input('type'),
                'starting_date'       =>  $request->input('starting_date'),
                'ending_date'         =>   $request->input('ending_date'),
                'reason_for_leave'     =>  $request->input('reason_for_leave'),
                'email'                =>  Auth()->user()->email,
            ]))
            {
                return true;
            }
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
	*  for displaying the datatable of the employee
	*  @param [type] $request
    *  @return response
	*/
    public function leaveInfo($request)
    {   
        try
        {  
            $draw                = $request->get('draw');
            $start               = $request->get("start");
            $rowPerPage          = $request->get("length");
            $orderArray          = $request->get('order');
            $columnNameArray     = $request->get('columns');
            $searchValue         = $request->get('search')['value'];
            $columnIndex         = $orderArray[0]['column'];
            $columnName          = $columnNameArray[$columnIndex]['data'];
            $columnSortOrder     = $orderArray[0]['dir'];
            $query               =EmployeeLeave::query();
            if (!empty($searchValue))
            {
                $query->where('phone_no', 'like', '%' . $searchValue . '%')
                ->orWhere('date_of_birth', 'like', '%' . $searchValue . '%');
            }
            $totalFilter = $query->count();
            $query->orderBy($columnName, $columnSortOrder);
            $query->skip($start)->take($rowPerPage);
            $arrData = $query->get();
            $response = array(
                "draw"              => intval($draw),
                "recordsTotal"      => EmployeeLeave::count(),
                "recordsFiltered"   => $totalFilter,
                "data" => $arrData,
            );
            return ($response); 
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }

    public function leaveStatus($email)
    {
        try
        {
            $abc ="123";
           $user = EmployeeLeave::where('email',$email)->first();
           if ($user->status == 'Approved') {
            return true;
        } elseif ($user->status == 'Rejected') {
            return false;
        } else 
            return null;
        
        
           
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
}