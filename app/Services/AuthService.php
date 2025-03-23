<?php
namespace App\Services;
use Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserLoggedInNotification;
use Illuminate\Support\Facades\Notification;

class AuthService
{ 
    /** 
	*  ffor authenticating the usere 
	*  
    *  @return void
	*/
    public function Auth()
    {   
        try
        {
            if(Auth::id())
            {
                if(Auth()->user()->role_id == '1')
                {
                    // $user = Auth()->User();
                    // Notification::send($user, new UserLoggedInNotification);
                    return true ;
                }
                else if(Auth()->user()->role_id == '2')
                {
                    // $user = Auth()->User();
                    // Notification::send($user, new UserLoggedInNotification);
                    return false;
                }
                else
                {
                    return null ;
                }
            }
        }catch(Exception $e)
        {
            Log::error('Exception encountered.' . $e);
            return null;
        }

    } 
}