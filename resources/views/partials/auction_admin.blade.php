<tr>
    <th scope="row">{{ $auction->id }}</th>
    <td>{{$auction->model->brand->name}} {{$auction->model->name}}</td>
    <td>{{ $auction->creation_date }}</td>
    <td>{{ $auction -> starting_bid/100 }}</td>
    <td>{{ $auction -> user->name }}</td>
    <td>{{ $auction -> duration }}</td>

    <td><a class="btn btn-secondary" href="" role="button">Aprove request</a></td>
</tr>
