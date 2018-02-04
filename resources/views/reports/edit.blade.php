@extends('layouts.app')

@section('content')
<h3>Редактировать отчёт</h3>
{!! Form::open(['action' => ['ReportsController@update'], 'method' => 'PUT']) !!}
    {!! Form::hidden('id', $report->id) !!}
<div class="row">
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                {{ Form::label('date', 'Дата') }}
                {{ Form::date('date', $report->date, ['class' => 'form-control', 'readonly']) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('hours', 'Кол-во часов') }}
                {{ Form::number('hours', $report->hours, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('comment', 'Комментарий') }}
        {{ Form::textarea('comment', $report->comment, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Введите комментарий...']) }}
    </div>
    <div class="row">
        @if(Auth::user()->role == 'admin')
            <a href="/admin/reports/'{{ $report->user_id }}" class="col-md-offset-8 btn btn-warning block col-md-2">Отмена</a>
        @else
            <a href="/" class="col-md-offset-8 btn btn-warning block col-md-2">Отмена</a>
        @endif
        <div class="col-md-2">
            {{ Form::submit('Отправить', ['class' => 'btn btn-block btn-primary']) }}
        </div>
    </div>

</div>
{!! Form::close() !!}
@endsection