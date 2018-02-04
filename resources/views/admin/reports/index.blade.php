@extends('layouts.app')

@section('content')
    <h2>Отчёт пользователя <span class=".text-success">{{ $user->login }} за {{ $month_rus }}</span></h2>
    {!! Form::open(['action' => ['Admin\UserReportsController@index', $user->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-6 col-md-3">
                {{ Form::submit('Отфильтровать', ['class' => 'btn btn-primary pull-right']) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('month', \App\Report::MONTH_RUS, intval(\Carbon\Carbon::today()->format('m')), ['class' => 'custom-select form-control ']) }}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @include('inc.reports')
    <hr>
    <h3>Настройки пользователя</h3>
    <hr>
    <div class="clearfix">
        {!! Form::open(['action' => ['Admin\UserReportsController@changeLogin', $user->id],'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group">
                    <p class="col-md-5">
                        Изменить логин пользователя <br>
                        <span class="small .text-danger">Для подтверждения обязателен пароль администратора.</span>
                    </p>
                    <div class="col-md-offset-1 col-md-3">
                        {{ Form::text('login', '', ['class' => 'form-control', 'placeholder' => 'Новый логин']) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Пароль администратора']) }}
                    </div>
            </div>

        </div>
            {{ Form::submit('Подтвердить', ['class' => 'btn btn-warning pull-right']) }}
        {!! Form::close() !!}
    </div>
    <hr>

    <div class="clearfix">
            {!! Form::open(['action' => ['Admin\UserReportsController@changePassword', $user->id],'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group">
                <p class="col-md-5">
                    Изменить пароль пользователя <br>
                    <span class="small .text-danger">Для подтверждения обязателен пароль администратора.</span>
                </p>
                <div class="col-md-offset-1 col-md-3">
                    {{ Form::password('user_password', ['class' => 'form-control', 'placeholder' => 'Новый пароль']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Пароль администратора']) }}
                </div>
            </div>

        </div>
        {{ Form::submit('Подтвердить', ['class' => 'btn btn-warning pull-right']) }}
        {!! Form::close() !!}
    </div>
    <hr>

    <hr>
    <div class="panel panel-danger">
        <div class="panel-heading">Удаление пользователя</div>
              <div class="row panel-body">
                    <p class="col-md-5">
                        Удалить пользователя и все его данные.<br>
                        <span class="small text-danger">Это действие нельзя будет отменить.</span>
                    </p>
                    <div class="col-md-offset-3 col-md-4">
                        <a href="/admin/delete/{{ $user->id }}"  style="display: block" class="btn btn-danger pull-right">Удалить</a>
                    </div>
              </div>
          </div>
    <hr>
    <p><a href="/admin" style="display: block" class="btn btn-block">< Назад</a></p>
@endsection