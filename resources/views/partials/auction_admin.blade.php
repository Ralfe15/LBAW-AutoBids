<tr>
    <th scope="row">{{ $auction->id }}</th>
    <td>{{$auction->model->brand->name}} {{$auction->model->name}}</td>
    <td>{{ $auction->creation_date }}</td>
    <td>{{ $auction -> starting_bid/100 }}</td>
    <td>{{ $auction -> user->name }}</td>
    <td>{{ $auction -> duration }}</td>

    <td style="text-align: center">
        <form method="POST" action="{{route('approve', ['id'=>$auction->id])}}">
            {{csrf_field()}}
            <button class="btn btn-success" type="submit" role="button">Approve</button>
        </form>
    </td>
    <td style="text-align: center">
        <form method="POST" action="{{route('deny', ['id'=>$auction->id])}}">
            {{csrf_field()}}
            <button class="btn btn-danger" type="submit" role="button">Deny</button>
        </form>
    </td>
</tr>
