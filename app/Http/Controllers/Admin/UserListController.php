<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserListController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();

        $users = $users->map(function ($user) {

            $user->hours_in_curr_month = DB::table('reports')
                ->where('user_id', $user->id)
                ->sum('hours');

            return $user;
        });

        return view('admin.index')->with('users', $users);
    }

    public function fullUserDelete($id)

    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('admin')->with('success', 'Пользователь успешно удален!');
    }

}
