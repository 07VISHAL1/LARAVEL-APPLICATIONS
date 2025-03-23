<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Log;

use AuthService;

class HomeController extends Controller
{
	
	/** 
	* determing the routes of the admin and the employee on the basis of the role_id given and servre view file accordingly
	* @return \Illuminate\Http\view 
	*/
	public function index()
	{
		try
		{
			$result = AuthService::Auth();
			if($result)
			{
				return view('dashboard');
			}
			elseif($result == false)
			{
				return view('admin\adminHome');	
			}
			else
			{
				return redirect()->back();
			}
		}
		catch(Exception $e) 
		{
			Log::error('Exception encountered in HomeController->index : ' . $e);
			return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.');
		}
	}
}
