<tr>
    <th scope="row"><a href="{{route('user_profile', ['id'=> $user->id]) }}">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->rating }}</td>
    <td>{{ $user->credits }}</td>
    <td><a class="btn btn-secondary" href="{{route('user_profile', ['id'=> $user->id]) }}" role="button">View Profile</a></td>
</tr>
