<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests\ProfileUpdateRequest;
use AuthService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     * @param Request $request
     * @return \Illuminate\Http\view 
     */
    public function edit(Request $request)
    {
        try
        {
            $result = AuthService::Auth();
			if($result == true)
			{
                return view('profile.EditEmployee', [
                    'user' => $request->user(),
                ]);
			}
			elseif($result == false)
			{
                return view('profile.EditAdmin', [
                    'user' => $request->user(),
                ]);
			}
			else
			{
				return redirect()->back();
			}
        }
        catch(Exception $e) 
        {
            Log::error('Exception encountered in profileController->edit : ' . $e);
            return redirect()->back()->with('Exception', 'profile-could not be loaded due  to exception in service');
        }    
    }

    /**
     * Update the user's profile information.
     * @param Request $request
     * @return \Illuminate\Http\view
     */
    public function update(ProfileUpdateRequest $request)
    {
        try
        {
            $result = AuthService::Auth();
			if($result == true)
			{
                $request->user()->fill($request->validated());
                if ($request->user()->isDirty('email')) {
                    $request->user()->email_verified_at = null;
                }
                $request->user()->save();
                    return redirect()->back()->with('status', 'profile-updated');
			}
			elseif($result == false)
			{
                $request->user()->fill($request->validated());
                if ($request->user()->isDirty('email'))
                {
                    $request->user()->email_verified_at = null;
                }
                $request->user()->save();
                 return redirect()->back()->with('status', 'profile-updated');
			}   
			else
			{
				return redirect()->back();
			}
           
        }catch(Exception $e) 
        {
            Log::error('Exception encountered in profileController->update : ' . $e);
            return redirect()->back()->with('Exception', 'profile-could not be updated due  to exception in service');
        }  
    }
}
