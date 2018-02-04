@if(count($reports) > 0)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата</th>
            <th scope="col" class="text-center">Кол-во</th>
            <th scope="col" class="text-center">Комментарий</th>
            <th scope="col"></th>
        </tr>
        <?php $counter = 1 ?>
        @foreach($reports as $report)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $report->date }}</td>
                <td class="text-center">{{ $report->hours }}</td>
                <td class="text-center">{{ $report->comment }}</td>
                <td><a href="/report/edit/{{ $report->id }}" class="btn btn-primary pull-right" role="button">Редактировать</a></td>
            </tr>
        @endforeach
    </thead>

</table>
@else
    <h3 class="text-center">Записей за этот период нет.</h3>
@endif
