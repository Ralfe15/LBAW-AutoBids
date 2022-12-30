<tr>
    <th scope="row">{{ $auction->id }}</th>
    <td>{{$auction->model->brand->name}} {{$auction->model->name}}</td>
    <td>{{ $auction->creation_date }}</td>
    <td>{{ $auction -> starting_bid/100 }}</td>
    <td>{{ $auction -> user->name }}</td>
    <td>{{ $auction -> duration }}</td>

    <td>
        <form method="POST" action="{{route('cancel', ['id'=>$auction->id])}}">
            {{csrf_field()}}
            <button class="btn btn-danger" type="submit" role="button">Cancel</button>
        </form>
    </td>
</tr>
