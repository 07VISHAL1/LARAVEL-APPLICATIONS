<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use EmployeeDetailsService;

class UserController extends Controller
{

    /**
     *  @return \Illuminate\Http\view 
     *  adding employee informations
     *  @param Request $request
     *  
    */
    public function adduserInfo(Request $request)
    {
        try
        {
            
            $id =Auth()->user()->id;
            $validate =validator::make($request->all(),[
                'phone_no'           => ['required', 'string', 'max:255'],
                'date_of_birth'      => ['required'],
                'date_of_joining'    => ['required'],
                'tax_regime'         => ['required'],
                'emrgency_phone_no' => ['required', 'string', 'max:255'],
                'employee_code'      => ['required'],
            ]);
            if($validate->fails()) 
                return redirect()->back()->with('errors', $validate->errors());
            $existingInfo = EmployeeDetailsService::employeeExist($id);
            if ($existingInfo)
             return redirect()->back()->with('Error', 'User Information already exists');
            else
            {  
                $result = EmployeeDetailsService::add($request ,$id);
                if($result == true)
                    return redirect()->back()->with('success', 'Employee Information Added successfuly');
                elseif($result==false)
                    return redirect()->back()->with('error', 'Employee Information could not be added');
                else
                    return redirect()->back()->with('error','Employee information cannot be loaded due to exception. Please try again.');
            }
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in EmployeeController->adduserInfo : ' . $e);
            return redirect()->back()->with('Exception','Employee cannot be loaded due to exception. Please try again.', [], 500);

        }
    }


    /**
     *  @return \Illuminate\Http\view 
     * for editing the particular employee info
     *  
    */
    public function editemployee()
    {
        try
        {
            $users=EmployeeDetailsService::editemployee();
            return view('auth.editEmployeeDetail',compact('users'));
        }
        catch(Exception $e) 
        {
         Log::error('Exception encountered in EmployeeController->editemployee : ' . $e);
         return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.', [], 500);
        }
    }
    
    /**
     *  @return \Illuminate\Http\view 
     * updating  employee informations
     *  @param Request $request
     *  
    */
    public function update(Request $request)
    {
        try
        { 
            $validate =validator::make($request->all(),[
                'phone_no'        => ['required', 'string', 'max:255'],
                'date_of_birth'   => ['required'],
                'date_of_joining' => ['required'],
            ]);
            if($validate->fails())
                return redirect()->back()->with('error',$validate->errors());
            $result = EmployeeDetailsService::update($request);
            if($result == true)
                return redirect()->back()->with('success', 'updated succesfully');
            elseif($result==false)
                return redirect()->back()->with('error', 'Employee could not be updted!');
            else
                return redirect()->back()->with('error','Employee could not be updted to exception. Please try again.');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in EmployeeController->update : ' . $e);
            return redirect()->back()->with('Exception','Employee could not be updted due to exception. Please try again.');
        }
    }


    public function leave()
    {
        try
        {
            return view('auth.leave');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in EmployeeController->leave : ' . $e);
            return redirect()->back()->with('Exception','Employee could not be updted due to exception. Please try again.');
        }
    }

    /**
     *  @return \Illuminate\Http\view 
     * updating  employee informations
     *  @param Request $request
     *  
    */

    public function employeeLeave(Request $request)
    {
        try
        { 
            $validate =validator::make($request->all(),[
                'type'            => ['required', 'string', 'max:255'],
                'starting_date'   => ['required'],
                'ending_date'     => ['required'],
                'reason_for_leave' => ['required'],

            ]);
            if($validate->fails())
                return response()->json(['errors' => $validate->errors()]);
            $result = EmployeeDetailsService::leave($request);
            if ($result) 
                return response()->json(['success' => 'Employee added successfully']);
            else 
                return response()->json(['error' => 'Employee could not be added due to exception in the service. Please try again.'], 500);
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in EmployeeController->update : ' . $e);
            return redirect()->back()->with('Exception','Employee could not be updted due to exception. Please try again.');
        }
    }

    /**
     *  @return \Illuminate\Http\view 
     * updating  employee informations
     *  @param Request $request
     *  
    */

    public function leaveStatus()
    {
        try
        { 
            $email  = Auth()->user()->email;
            $result = EmployeeDetailsService::leaveStatus($email);
            if ($result) 
                return response()->json(['success' => 'Request Approved']);
            else if(!$result )
                return response()->json(['success' => 'Rejected or it may pe pending.']);
            else 
                return response()->json(['error' => 'Pending. Please try again.'], 500);
    
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in EmployeeController->update : ' . $e);
            return redirect()->back()->with('Exception','Employee could not be updted due to exception. Please try again.');
        }
    }
    
}