@extends('layouts.default')
@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
    
</head>

<div class="content-wrapper">
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Rating</th>
            <th scope="col">Credits</th>
            <th scope="col">Profile Link</th>
          </tr>
        </thead>
        <tbody>
            @each('partials/user', $users, 'user')
        </tbody>
      </table>
    
    
    </section>
</div>
@stop

