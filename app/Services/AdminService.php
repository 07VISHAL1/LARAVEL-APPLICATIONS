<?php
namespace App\Services;
use Log;
use App\Models\Employer;
use App\Models\User;
use App\Models\EmployeeLeave;


class AdminService
{
    
    /** 
	*  for adding the details of the admin 
	*  @param data
    *  @return void
	*/
    public function add($request, $id)
    {
        try
        {
           if($user            = employer::create([
                'user_id'       => $id,
                'phone_no'      =>  $request->input('phone_no'),
                'address'       =>  $request->input('address'),
                'company_name'  =>  $request->input('company_name'),                
            ]))
            return $user;
     
        }
        catch(Exception $e)
        {       
            Log::error('Exception encountered.' . $e);
            return null;
        }
    }
     /** 
	*  for updating the details of the admin
	*  @param request
    *  @return void
	*/
    public function update($request, $id)
    {
        try
        {  
            $user               = Employer::where('user_id',$id)->first();
            $user->phone_no     = $request->input('phone_no');
            $user->address      = $request->input('address');
            $user->company_name = $request->input('company_name');
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
	*  for editing the details of the admin 
	*  @param request
    *  @return void
	*/
    public function edit($request,$id)
    {
        $users= Employer::where('user_id',$id)->first();
        return $users;
    }

    public function adminExist($request, $id)
    {
        try
        {
            $existingInfo = Employer::where('user_id',$id)->first();
            return $existingInfo;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }

    }
    public function leaveInfo($request)
    {
        try
        {
            $id           = $request->id;
            $existingInfo = EmployeeLeave::where('id',$id)->first();
            return $existingInfo;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }

    }

    public function leaveUpdated($request)
    {
        try
        {
            $id             = $request->id;
            $user           = EmployeeLeave::where('id',$id)->first();
            $user->status = $request->input('status');
            $user->save();
            return $user;
        }
        catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }

    }
}