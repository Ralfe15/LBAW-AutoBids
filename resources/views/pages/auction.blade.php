@include('partials/header')

<<<<<<< HEAD
<h1> Model: {{$auction->model->name}}</h1>
<h1> Number of bids: {{$auction->number_bids}}</h1>
<h1>started at: {{$auction->start_date}}</h1>
<h1>time remainig: {{$time_remaining}}</h1>
<h1> Description: {{$auction->description}}</h1>
<h1> Mileage {{$auction->mileage}}</h1>
<h1> Year: {{$auction->year}}</h1>

<h1>current bid is: {{$current_bid}}</h1>

@if(Auth::check() && $can_bid && (Auth::user()->credits/100) >= $current_bid)
<form action="{{route('bid', ['id'=>$auction->id])}}" class="search" method="POST">
    @method('PUT')
    {{csrf_field()}}
    <label>Enter the value to bid! Minimum bid: U${{bid_step($current_bid)}}</label>
    <input type="number" min='{{bid_step($current_bid)}}' name="bid" id="bid" step="0.01">
    <input type="hidden" value="{{bid_step($current_bid)}}" name="minimum">
    <input type="hidden" value="{{$current_bid}}" name="prev_bid">
    <input type="hidden" value="{{$prev_id}}" name="prev_id">
    <button type="submit">Bid now!</button>
</form>
@include('partials/error_list_validator')
@endif
