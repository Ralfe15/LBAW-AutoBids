@include('partials/header')

<body>
    <section class='auction-title'>
        <h1>{{$auction->model->brand->name}} {{$auction->model->name}} </h1>
    </section>
</body>

<h1> {{$auction->model->name}}</h1>
<h1> {{$auction->number_bids}}</h1>
<h1> {{$auction->starting_bid}}</h1>
<h1> {{$auction->start_date}}</h1>
<h1> {{$auction->creation_date}}</h1>
<h1> {{$auction->end_date}}</h1>
<h1> {{$auction->approved}}</h1>
<h1> {{$auction->description}}</h1>
<h1> {{$auction->views}}</h1>
<h1> {{$auction->duration}}</h1>
<h1> {{$auction->year}}</h1>
<h1> {{$auction->mileage}}</h1>
<h1> {{$auction->displacement}}</h1>
<h1> {{$auction->rating}}</h1>
<h1> {{$auction->vin}}</h1>
<h1> {{$auction->power}}</h1>
<h1> {{$auction->color}}</h1>
<h1> {{$auction->active}}</h1>
<h1> {{$auction->id_member}}</h1>
<h1> {{$auction->id_model}}</h1>
<h1> {{$auction->id_category}}</h1>


