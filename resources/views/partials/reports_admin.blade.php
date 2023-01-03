<tr>

    <td>{{ $report->user->name }}</td>
    <td>
        <a href="{{route('detail', ['id'=>$report->id_auction])}}">{{$report->auction->model->brand->name}} {{$report->auction->model->name}}</a>
    </td>
    <td>{{ $report->date }}</td>
    <td>{{ $report->description }}</td>


    <td style="text-align: center">
        <form method="POST" action="{{route('solved')}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$report->id_member}}" name="id_member">
            <input type="hidden" value="{{$report->id_auction}}" name="id_auction">

            <button class="btn btn-danger" type="submit" role="button">Mark as solved</button>
        </form>
    </td>
    <td style="text-align: center">
        <form method="POST" action="{{route('abort', ["id"=>$report->id_auction])}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$report->id_member}}" name="id_member">
            <input type="hidden" value="{{$report->id_auction}}" name="id_auction">
            <button class="btn btn-outline-danger" type="submit" role="button">Abort auction</button>
        </form>
    </td>
</tr>
