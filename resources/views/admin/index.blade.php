@extends('layouts.app')

@section('content')
    <h2>Список пользователей системы</h2>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col" class="text-center">Пароль</th>
            <th scope="col" class="text-center">Кол-во часов/месяц</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <?php $counter = 1; ?>
            @if(count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $user->login }}</td>
                        <td class="text-center"><i>Encrypted</i></td>
                        <td class="text-center"><i>{{ $user->hours_in_curr_month }}</i></td>
                        <td><a href="/admin/reports/{{ $user->id }}" class="btn btn-primary pull-right">Открыть</a></td>
                    </tr>
                @endforeach
            @endif
    </table>
@endsection
