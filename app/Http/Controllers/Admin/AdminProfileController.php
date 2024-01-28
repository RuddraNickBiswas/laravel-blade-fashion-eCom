<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminPasswordUpdateRequest;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return view('admin.profile.index');
    }


    public function updateProfile(AdminProfileUpdateRequest $request)
    {
        // dd($request->all());
        $user = Auth::user();
        
        $imagePath = $this->uploadImage(
            request: $request,
            inputName: 'avater',
            path: 'uploads/image/avater',
            oldPath: $user->avater,
            resizeWidth: 500,
            resizeHeight: 500
        );
        
        
        $user->avater = isset($imagePath) ? $imagePath : $user->avater;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr('Profile update successfull', 'success');
        return redirect()->back();
    }

    public function updatePassword(AdminPasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        toastr('Password update successfull', 'success');
        return redirect()->back();
    }
}
