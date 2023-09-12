<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Auth;
use Session;

class AuthController extends Controller
{
    public function profile()
    {
        return view('admin.profile');
    }

    public function update(AuthRequest $request)
    {
        $passwordArr = [];
        $profileDetails = [
            'name'      => $request->name,
            'email'     => $request->email,
        ];

        if(!empty($request->password))
        {
            $passwordArr = array('password' => bcrypt($request->password));
        }

        $profileInfo = array_merge($profileDetails,$passwordArr);

        $user = User::where('id',Auth::user()['id'])->update($profileInfo);

        Session::flash('message', 'Profile updated successfully.'); 

        return view('admin.profile');
    }

    public function updateImage(Request $request)
    {
        if($request->image)
        {
            $data = $request->image;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'uploads/profile_images/' . 'IMG' . date('YmdHis') . uniqid()  . '.png';

            $result = file_put_contents($image_name, $data);
            if($result)
            {
                if(file_exists(Auth::user()['profile_image'])) {
                    @unlink(Auth::user()['profile_image']);
                }
            }
            $user = User::where('id',Auth::user()['id'])->update(['profile_image'=>$image_name]);
           
            if($user)
            {
                $userObj = User::find(Auth::user()->id);
                Auth::setUser($userObj);
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}
