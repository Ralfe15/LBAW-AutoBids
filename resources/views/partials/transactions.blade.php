<tr>
    <th scope="row">{{ $transaction->id }}</th>
    <td>{{$transaction->user->name}}</td>
    <td><a href="/user/{{ $transaction->user->id }}">Profile</a></td>
    <td>{{ $transaction -> type }}</td>
    <td>{{ $transaction -> value/100 }}</td>
    <td style="text-align: center">
        <form method="POST" action="{{route('approve-transaction', ['id'=>$transaction->id])}}">
            {{csrf_field()}}
            <button class="btn btn-success" type="submit" role="button">Approve request</button>
        </form>
    </td>
    <td style="text-align: center">
        <form method="POST" action="{{route('deny-transaction', ['id'=>$transaction->id])}}">
            {{csrf_field()}}
            <button class="btn btn-danger" type="submit" role="button">Deny request</button>
        </form>
    </td>
</tr>
