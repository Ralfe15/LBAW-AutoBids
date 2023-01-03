@extends('layouts.default')
@section('content')



    <head>
        <link href="{{ asset('css/transaction.css') }}" rel="stylesheet">
        <title>Create Transaction</title>
    </head>
    <div class="title-wrapper">
        <h1>Deposit/Withdraw Funds</h1>
    </div>
    @foreach ($errors->all() as $message)
        <h1>{{$message}}</h1>
    @endforeach
    <div class="form-wrapper">
        <div class="form">
            <form method="POST" action="{{ route('create-transaction') }}" id="createtransaction-form">
                {{ csrf_field() }}
                <div class="form-transaction">
                    <label for="transactionForm" class="form-label">Transaction Method</label>
                    <select required class="form-select" name="transaction">
                        <option value="SelectMethod" selected>Select Method..</option>
{{--                        <option value="Paypal" >Paypal</option>--}}
                        <option value="BankTransfer">Bank Transfer</option>

                    </select>
                </div>
                <div class="form-type">
                    <label for="typeForm" class="form-label">Transaction Type</label>
                    <select required class="form-select" name="type">
                        <option value="SelectType" selected>Select Type..</option>
                        <option value="Deposit">Deposit</option>
                        <option value="Withdraw">Withdraw</option>

                    </select>
                </div>

{{--                <div class="form-email">--}}
{{--                    <label for="emailForm" class="form-label">Email</label>--}}
{{--                    <input required type="email" class="form-control" name="email" id="email-form" placeholder="Ex:name@domain.tld">--}}
{{--                </div>--}}
                <div class="form-value">
                    <label for="valueForm" class="form-label">Value</label>
                    <input required type="number" class="form-control" name="value" min=0 id="value-form" placeholder="Ex: 12727">
                </div>




                <div class="submit-button">
                    <button type="submit" class="btn btn-outline-danger">
                        Submit Transaction
                    </button>
                </div>
            </form>

            {{--    TODO: Handle error messages--}}
        </div>
    </div>

@stop
