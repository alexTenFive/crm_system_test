<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Report;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentMonth = intval(Carbon::today()->format('m'));

        if (is_null($request->month)) {
            $month = $currentMonth;
        } else {
            $month = intval($request->month);
        }

        $reports = Report::where('user_id', Auth::id())
            ->whereMonth('date', $month)
            ->get();

        return view('reports.index')
            ->with(['reports' => $reports,
                    'month_rus' => mb_strtolower(Report::MONTH_RUS[$month])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'hours' => 'required',
        ]);
        
        //Create report
        $report = new Report;
        $report->date = $request->input('date');
        $report->hours = $request->input('hours');
        $report->comment = $request->input('comment');
        $report->user_id = Auth::id();
        $report->save();

        return redirect('user/reports')->with('success', 'Запись добавлена!');
    }

    public function edit($report_id)
    {
        $report = Report::find($report_id);

        if(!is_null($report_id)) {
            return view('reports.edit')->with('report', $report);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $report = Report::find(intval($request->id));
        $report->hours = $request->hours;
        $report->comment = $request->comment;
        $report->save();

        if(Auth::user()->role == 'admin')
            return redirect('/admin/reports/'.$report->user_id)->with('success', 'Отчёт пользователя отредактирован!');
        return redirect('/')->with('success', 'Отчёт отредактирован!');
    }

}
