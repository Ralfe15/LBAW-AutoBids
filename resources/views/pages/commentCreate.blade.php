@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/commentCreate.css') }}" rel="stylesheet">
    </head>
    <div class="comment-create-title">
        <h1 style="text-align: center;">Create Comment</h1>
    </div>
    <div class="form">
        <form method="POST" action="{{ route('create-comment') }}" id="form_comment">
            {{ csrf_field() }}
            <div class="content">
                <label for="commentForm" class="form-label">Comment</label>
                <input type="textarea" class="form-control" name="content" id="content-form" autofocus>
            </div>
            <div class="form-auction">
                <input type="hidden" class="form-control" name="id_auction" id="auction-form" value=" {{ $auction_id }}">
            </div>
            <div class="form-parent">
                <input type="hidden" class="form-parent" name="id_comment" id="parent-form" value="{{ $parent }}">
            </div>
            <div class="button-wrapper">
                <button class="btn btn-secondary" type="submit">
                    Submit
                </button>
            </div>
        </form>

        {{--    TODO: Handle error messages--}}
    </div>
@stop
