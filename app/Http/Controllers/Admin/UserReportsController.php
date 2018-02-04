<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserReportsController extends Controller
{
    public function index($id, Request $request)
    {
        $currentMonth = intval(Carbon::today()->format('m'));
        if (is_null($request->month)) {
            $month = $currentMonth;
        } else {
            $month = intval($request->month);
            }

        $reports = Report::where('user_id', $id)
            ->whereMonth('date', $month)
            ->get();

        return view('admin.reports.index')
            ->with(['reports' => $reports,
                    'user' => User::find($id),
                    'month_rus' => mb_strtolower(Report::MONTH_RUS[$month])]);
    }

    public function changeLogin(Request $request, $id)
    {
        $this->validate($request, [
            'login' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::find($id);
        if (!is_null($user) && Hash::check($request->password, Auth::user()->password)) {
            $user->login = $request->login;
            $user->save();

            return redirect("/admin/reports/$user->id")
                ->with('success', 'Логин пользователя успешно изменен!');
        } else {
            return redirect("/admin/reports/$user->id")
                ->with('error', 'Логин пользователя изменить не удалось!');
        }

    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'user_password' => 'required|string|min:6',
            'password' => 'required|string',
        ]);

        $user = User::find($id);
        if (!is_null($user) && Hash::check($request->password, Auth::user()->password)) {
            $user->password = bcrypt($request->user_password);
            $user->save();

            return redirect("/admin/reports/$user->id")
                ->with('success', 'Пароль пользователя успешно изменен!');
        } else {
            return redirect("/admin/reports/$user->id")
                ->with('error', 'Пароль пользователя изменить не удалось!');
        }
    }

    public function test($id, $month)
    {
        dd($id, $month);
    }


}
