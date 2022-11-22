@extends('layouts.default')
@section('content')



    <head>
        <link href="{{ asset('css/createPaypal.css') }}" rel="stylesheet">
    </head>
    <div class="title-wrapper">
        <h1>Paypal Transaction</h1>
    </div>
    @foreach ($errors->all() as $message)
        <h1>{{$message}}</h1>
    @endforeach
    <div class="form-wrapper">



        <div class="form">
            <form method="POST" action="{{ route('create-paypal') }}" id="form_createpaypal">
                {{ csrf_field() }}
                <div class="form-type">
                    <label for="typeForm" class="form-label">Transaction Type</label>
                    <select required class="form-select" name="type">
                        <option value="Deposit" selected>Deposit</option>
                        <option value="Withdraw" selected>Withdraw</option>

                    </select>
                </div>

                <div class="email-form">
                    <label for="emailForm" class="form-label">Email</label>
                    <input required type="email" class="form-control" name="email" id="email-form" placeholder="Ex:name@domain.tld">
                </div>
                <div class="value-form">
                    <label for="valueForm" class="form-label">Value</label>
                    <input required type="number" class="form-control" name="value" min=0 id="value-form" placeholder="Ex: 12727">
                </div>

                <div class="line"></div>


                <div class="submit-button">
                    <button type="submit" class="btn btn-secondary">
                        Create Auction
                    </button>
                </div>
            </form>

            {{--    TODO: Handle error messages--}}
        </div>
    </div>

@stop
