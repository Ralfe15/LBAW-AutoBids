<tr>

    <td>{{ $report->user->name }}</td>
    <td><a href="{{route('detail', ['id'=>$report->id_auction])}}">{{$report->auction->model->brand->name}} {{$report->auction->model->name}}</a></td>
    <td>{{ $report->date }}</td>


    <td>
        <form method="POST" action="{{route('solved')}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$report->id_member}}" name="id_member">
            <input type="hidden" value="{{$report->id_auction}}" name="id_auction">

            <button class="btn btn-secondary" type="submit" role="button">Mark as solved</button>
        </form>
    </td>
</tr>
