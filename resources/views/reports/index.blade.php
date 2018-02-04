@extends('layouts.app')

@section('content')
    <h2>Отчёт за {{ $month_rus }}</h2>
    {!! Form::open(['action' => ['ReportsController@index'], 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-6 col-md-3">
                    {{ Form::submit('Отфильтровать', ['class' => 'btn btn-primary pull-right']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::select('month', \App\Report::MONTH_RUS, intval(\Carbon\Carbon::today()->format('m')), ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    @include('inc.reports')
    <h3>Отправить отчёт</h3>
    {!! Form::open(['action' => 'ReportsController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('date', 'Дата') }}
                    {{ Form::date('date', \Carbon\Carbon::today(), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label('hours', 'Кол-во часов') }}
                    {{ Form::number('hours', '', ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('comment', 'Комментарий') }}
            {{ Form::textarea('comment', '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Введите комментарий...']) }}
        </div>
        {{ Form::submit('Отправить', ['class' => 'btn btn-primary pull-right']) }}
    </div>
    {!! Form::close() !!}

@endsection
