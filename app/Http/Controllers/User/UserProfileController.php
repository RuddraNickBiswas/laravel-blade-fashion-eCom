<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPasswordUpdateRequest;
use App\Http\Requests\User\UserProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    use FileUploadTrait;
    public function index() {
        return view('frontend.dashboard.profile');
    }


 
    public function profileUpdate(UserProfileUpdateRequest $request)
    {
        $user = Auth::user();
        
        $imagePath = $this->uploadImage(
            request: $request,
            inputName: 'avater',
            path: 'uploads/image/avater',
            oldPath: $user->avater,
            resizeWidth: 500,
            resizeHeight: 500
        );
        // dd($imagePath);
        $user->avater = isset($imagePath) ? $imagePath : $user->avater;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr('Profile update successfull', 'success');
        return redirect()->back();
    }

    public function passwordUpdate(UserPasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        toastr('Password update successfull', 'success');
        return redirect()->back();
    }
}
