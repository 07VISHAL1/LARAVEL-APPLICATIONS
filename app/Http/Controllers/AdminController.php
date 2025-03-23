<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use App\Services\UserService;
use AdminService;
use EmployeeDetailsService;
use SalaryService;
use EmployeeListService;
use App\Models\User;

class AdminController extends BaseController
{

    /**
     * Display the registration view.
     *  @return \Illuminate\Http\view
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function createEmployee()
    {
		try
		{
        	return view('auth.registerEmployee');	
		}
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->createEmployee : ' . $e);
            return $this->sendError('An error occurred while loading the view file.', [], 500);
        }  
    }

    /**
     * storing the employee details
     * @return \Illuminate\Http\view
     * @param Request $request
    */
    public function storeEmployee(Request $request)
    {   
        try
        {
            $validate = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
                'password' => ['required','string','min:8',],
                'image' => ['required','file','image', 'mimes:jpeg,png,jpg,gif,svg','max:2048',]
                ]);
            if ($validate->fails())
            return redirect()->back()->with('errors', $validate->errors());
            $result = $this->userService->create($request);
            if($result) 
            {
                return redirect()->route('user-list', ['success' => 'Information added successfully']);
            }else 
            return redirect()->back()->with('errors','Information could  not added due to some error. Please try again.');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee :' . $e);
            return redirect()->back()->with('Exception','Employee could  not added due to exception in the service. Please try again.');
        }
    }
    /**
     * Display the admin view.
     * @return \Illuminate\Http\view
     * 
    */
    public function admininfo()
    {
        try
        {
            return view('auth.AdminInfo');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered. :' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.', [], 500);
        } 
    }
    
 	/**
     * saving the admin informations 
     * @return \Illuminate\Http\view
     * @param Request $request
     */
    public function addAdmininfo(Request $request)
    {
        try
        {
            $id = Auth()->User()->id;
            $validate =validator::make($request->all(),[
                'phone_no'     => ['required', 'string', 'max:255'],
                'company_name' => ['required', 'string', 'max:255'],
                'address'      => ['required', 'string', 'max:255'],
            ]);
            if($validate->fails())
            return redirect()->back()->with('errors', $validate->errors());
            $existingInfo = AdminService::adminExist($request,$id);
            if ($existingInfo)
             return redirect()->back()->with('Error', 'User Information already exists');
            else
            {
                $result = AdminService::add($request, $id);
                if($result)
                    return redirect()->back()->with('success', 'Information added successfuly');
                else
                    return redirect()->back()->with('errors','Information could  not added due to some error. Please try again.');
            }
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee : ' . $e);
            return redirect()->back()->with('Exception','Employee could  not added due to exception in the service. Please try again.');

        }
        
    }

    /**
    * Display the admin information for editing.
    * @param Request $request
    * @return \Illuminate\Http\view
    */
    public function editadmin(Request $request)
    {
        try
        {
            $id =Auth()->User()->id;
            $users = AdminService::edit($request,$id);
            return view('auth.editAdminDetail',compact('users'));
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->editadmin: ' . $e);
            return redirect()->back()->with('Error','Edit admin file could  not be loaded due  to exception in the service. Please try again.');

        }
    }

	/**
     * Display the registration view.
     * @param Request $request
     * @return \Illuminate\Http\view
    */
	public function updateAdmin(Request $request)
    {
        try
        {
            $id =Auth()->User()->id;
            $validate =validator::make($request->all(),[
                'phone_no'        => ['required', 'string', 'max:255'],
                'address'         => ['required'],
                'company_name'    => ['required'],
            ]);
            if($validate->fails())
                return redirect()->back()->with('errors', $validate->errors());
            $result   = AdminService::update($request,$id);
            if($result)
                return redirect()->back()->with('success', 'Information updated ');
            else
                return redirect()->back()->with('Error', 'Information could not be updated due to exception');

        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->updateAdmin: ' . $e);
			return $this->sendError('Admin  could  not be  due to exception in the service. Please try again.');
        }
    }
       /** 
    * showing the list file in the view that contain the data of the employees
    * @return \Illuminate\Http\view 
    */
    public function list()
    {
        try
        {
            $user_data = User::where('status','1')->where('role_id','1')->get();
            return view('EmployeeList',compact('user_data'));
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered in Admincontroller->list ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
        }
    }

    /** 
    * showing data of the employees with the help of data tables
    * @param Request $request
    * @return \Illuminate\Http\Response
    */

    public function dataTable(Request $request) 
    {
        try
        {
            $response = EmployeeListService::add($request);
            return response()->json($response);
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee ' . $e);
            return redirect()->back()->with('Exception','Response cannot be loaded due to exception. Please try again.');
        }
    }

    /** 
    * showing the blade file which conatians the employee informations
    * @return \Illuminate\Http\view 
    */

    public function employeeData()
    {
        try
        {
            return view('EmployeeInfoList');
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered in AdminController ->employeeData' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.', [], 500);
        }
    }
    
    /** 
    *  getting data for the datatables and showing the informations of the employees
    *  @param Request $request
    *  @return \Illuminate\Http\Response
    */
    
    public function getEmployeeData(Request $request)
    {
        try
        {
            $response = EmployeeDetailsService::show($request);
            return response()->json($response);
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered in Admincontroller->getEmployeeData ' . $e);
            return redirect()->back()->with('Exception','Response cannot be loaded due to exception. Please try again.', [], 500);
        }
    }
    
    /**
     *  @return \Illuminate\Http\view 
     * adding particular employee salary displaying view file
     * 
    */
    public function salary()
    {
        try
        {
            $user= SalaryService::dropdown();
            return view('auth.addsalary',compact('user'));
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->salary : ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.', [], 500);
        }
    }

    /**
     *  @return \Illuminate\Http\view 
     *  adding employee particular salary
     *  @param Request $request
     *  
    */
    public function addsalary(Request $request)
    {
        try
        {
            $validate =validator::make($request->all(),[
            'employee_id'   => ['required', 'string', 'max:255'],
            'year'          => ['required','string', 'max:255'],
            'amount'        => ['required','string', 'max:255'],
            ]);
            if($validate->fails())
                return redirect()->back()->with('errors', $validate->errors());
            $result = SalaryService::add($request);
            if($result)
                return redirect()->back()->with('success', 'salary added succesfully');
            elseif($result == null)
                return redirect()->back()->with('Error', 'salary of the user already exists');
            else
                return redirect()->back()->with('Error','salary could not be added due to exception.', [], 500);
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee : ' . $e);
            return redirect()->back()->with('Exception','salardy could not be  be ladded dueto exception. Please try again.', [], 500);
        }
       
    }

    /**
     * display register view file 
     * 
     * @return \Illuminate\Http\view
    */
    public function addemployee()
    {
        try
        {
            return view('auth.employeeInfo');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->addemployee : ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
        }
    }
    /**
     * display register view file 
     * 
     * @return \Illuminate\Http\view
    */
    public function leaveInfo()
    {
        try
        {
            return view('auth.LeaveInfo');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->addemployee : ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
        }
    }
       /**
     * display register view file 
     * 
     * @return \Illuminate\Http\view
    */
    public function getLeaveInfo(Request $request)
    {
        try
        {
            $response = EmployeeDetailsService::leaveInfo($request);
            return response()->json($response);
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->addemployee : ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
        }
    }
        /**
     * display register view file 
     * 
     * @return \Illuminate\Http\view
    */
    public function leaveFile(Request $request)
    {
        try
        {
            
            $user = AdminService::leaveInfo( $request);
            return view('auth.LeaveRequest',compact('user'));
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->addemployee : ' . $e);
            return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
        }
    }
     /**
     *  @return \Illuminate\Http\view 
     *  adding employee particular salary
     *  @param Request $request
     *  
    */
    public function updateLeave(Request $request)
    {
            try
            {
                $validate =validator::make($request->all(),[
                'status'   => ['required', 'string', 'max:255'],
                ]);
                if($validate->fails())
                    return redirect()->back()->with('errors', $validate->errors());
                $result = AdminService::leaveUpdated($request);
                if($result)
                    return redirect()->back()->with('success', 'updated succesfully');
                elseif($result == null)
                    return redirect()->back()->with('Error', ' could not be updated');
                else
                    return redirect()->back()->with('Error',' could not be added due to exception.', [], 500);
            }
            catch(Exception $e) 
            {
                Log::error('Exception encountered in Admincontroller->storeEmployee : ' . $e);
                return redirect()->back()->with('Exception','salardy could not be  be ladded dueto exception. Please try again.', [], 500);
            }
       
    }

    public function editUserDetails(Request $request)
    {
        try
        {
            $id = isset($request->id) ? $request->id : null; 
            $user= User::where('id',$id)->first();
            return view('auth.edit-user',compact('user'));
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee : ' . $e);
            return redirect()->back()->with('Exception','salardy could not be  be ladded dueto exception. Please try again.', [], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try
        {
            $validate = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
                'image' => ['required','file','image', 'mimes:jpeg,png,jpg,gif,svg','max:2048',]
                ]);
            if ($validate->fails())
            return redirect()->back()->with('errors', $validate->errors());
            $result = $this->userService->edit($request);
            if($result) 
            {
            return redirect()->back()->with('success', 'Information Edited successfuly');
            }else 
            return redirect()->back()->with('errors','Information could  not added due to some error. Please try again.');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee :' . $e);
            return redirect()->back()->with('Exception','Employee could  not added due to exception in the service. Please try again.');
        }
    }
    public function deleteUser(Request $request, $id)
    {
        try
        {
            $id = isset($id) ? $id : null; 
            $user= User::where('id',$id)->first();
            $user->status = '0';
            $user->save();
            if($user->save()) 
            {
            return redirect()->back()->with('success', 'Deleted Successfully');
            }else 
            return redirect()->back()->with('errors','Information could  not Deleted due to some error. Please try again.');
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in Admincontroller->storeEmployee :' . $e);
            return redirect()->back()->with('Exception','Employee could  not added due to exception in the service. Please try again.');
        }
    }
}
