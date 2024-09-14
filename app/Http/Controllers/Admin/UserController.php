<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use App\Models\User;

class UserController extends Controller
{
    /**
     * 
     * 
     * @return view
     */
    public function UserList() : View
    {
        $user_list = User::where('role', '2')->get();
        return view('admin.user.list',compact('user_list'));

    }

     /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function UserStatus($id): Redirector|RedirectResponse
    {
        try {
            $user_status = User::find($id);
            if($user_status->status == 0){
                $user_status->status = 1;
            }else{
                $user_status->status = 0;
            }
            $user_status->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.users.list'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.users.list'));
        }
    }
}
