@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/commentCreate.css') }}" rel="stylesheet">
    </head>
    <div class="comment-create-title">
        <h3 style="text-align: center;">Create Report</h3>
    </div>
    <div class="form-box">
        <div class="form">
            <form method="POST" action="{{ route('create-report') }}" id="form_comment">
                {{ csrf_field() }}
                <div class="content">
                    <label for="commentForm" class="form-label">Report</label>
                    <textarea class="form-control" name="content" id="content-form" rows="3" placeholder="Insert your report description here..." autofocus></textarea>
                </div>
                <div class="form-auction">
                    <input type="hidden" class="form-control" name="id_auction" id="auction-form" value="{{ $auction_id }}">
                </div>
                <div class="button-wrapper">
                    <button class="btn btn-outline-danger" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
