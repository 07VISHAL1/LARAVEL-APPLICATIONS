<?php
namespace App\Services;
use Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;


class UserService
{
    
    /** 
	*  for adding the details of the employee
	*  
    *  @return void
	*/    
    public function create($request)
    {
        try
        {
            if ($request->hasFile('image')) {
                $image = $request->file('image'); 
                $extension = $image->getClientOriginalExtension(); 
                $filename = time() . '.' . $extension; 
                $destinationPath = public_path('images/');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move($destinationPath, $filename);
                $imagePath = 'images/' . $filename;
            }
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                $user->image_path = $imagePath;
                $user->role_id = 1;
            if($user->save())
            {
                $info=Auth::User();
                $abc['token'] = $info->createToken($request['email'])->plainTextToken;
                $abc['info'] = $info;
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

    public function edit($request)
    {
        try
        {
            if ($request->hasFile('image')) {
                $image = $request->file('image'); 
                $extension = $image->getClientOriginalExtension(); 
                $filename = time() . '.' . $extension; 
                $destinationPath = public_path('images/');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move($destinationPath, $filename);
                $imagePath = 'images/' . $filename;
            }
                $user = User::where('id',$request->id)->first();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if($request->input('password') != null){
                 $user->password = Hash::make($request->input('password')) ;
                }
                $user->image_path = $imagePath;
                $user->role_id = 1;
            if($user->save())
            {
                $info=Auth::User();
                $abc['token'] = $info->createToken($request['email'])->plainTextToken;
                $abc['info'] = $info;
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

}