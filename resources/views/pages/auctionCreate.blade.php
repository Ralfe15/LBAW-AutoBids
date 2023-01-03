@extends('layouts.default')
@section('content')

    <head>
        <link href="{{ asset('css/createAuction.css') }}" rel="stylesheet">
    </head>
    <div class="title-wrapper">
        <h1>Create Auctions</h1>
    </div>

    <div class="d-flex justify-content-center">
        @foreach ($errors->all() as $message)
            <h2 style="color: red">{{$message}}</h2>
        @endforeach
    </div>

    <div class="form-wrapper">


        <div class="form">
            <form method="POST" action="{{ route('create-auction') }}" id="createauction-form"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="details-wrapper">
                    <h3>Vehicle Details</h3>
                </div>
                <div class="line"></div>
                <div class="form-category">
                    <label for="vinForm" class="form-label">Category</label>

                    <select required class="form-select" name="id_Category">
                        <option value="" {{ (old("id_Category") ? "":"selected") }}>Select Category...</option>
                        @foreach($categories as $category)
                            <option value='{{ $category->id}}' {{ (old("id_Category") == $category->id ? "selected":"") }}> {{ $category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-model">
                    <label for="vinForm" class="form-label">Brand & Model</label>
                    <select required class="form-select" name="id_Model">
                        <option value="" {{ (old("id_Model") ? "":"selected") }}>Select Model...</option>
                        @foreach($car_brands as $car_brand)
                            <option disabled style="background-color: lightgray; color: black"
                                    value='{{ $car_brand->id}}'> {{ $car_brand->name}}</option>
                            @foreach($car_models as $car_model)
                                @if($car_brand->id == $car_model->id_brand)
                                    <option value='{{ $car_model->id}}' >&nbsp&nbsp {{ $car_model->name}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="vin-form">
                    <label for="vinForm" class="form-label">VIN</label>
                    <input required type="text" class="form-control" name="vin" minlength="17" maxlength="17"
                           id="vin-form" value="{{ old('vin') }}" placeholder="Ex: 2G1WC5E37D1135027">
                </div>
                <div class="mileage-form">
                    <label for="mileageForm" class="form-label">Mileage</label>
                    <input required type="number" class="form-control" name="mileage" value="{{ old('mileage') }}" min=0 id="mileage-form"
                           placeholder="Ex: 12727">
                </div>
                <div class="year-form">
                    <label for="yearForm" class="form-label">Year</label>
                    <input required type="number" class="form-control" name="year" value="{{ old('year') }}" min="1900" max="2099" id="year-form"
                           placeholder="Ex: 2012">
                </div>

                <div class="technical-wrapper">
                    <h3>Technical Details</h3>
                </div>
                <div class="line"></div>
                <div class="power-form">
                    <label for="powerForm" class="form-label">Power</label>
                    <input required type="number" min=0 class="form-control" name="power" value="{{ old('power') }}" id="power-form"
                           placeholder="Ex: 227">
                </div>
                <div class="displacement-form">
                    <label for="displacementForm" class="form-label">Displacement</label>
                    <input required type="number" min="1" class="form-control" name="displacement" value="{{ old('displacement') }}"
                           id="displacement-form" placeholder="Ex: 2000">
                </div>
                <div class="color-form">
                    <label for="colorForm" class="form-label">Color</label>
                    <input required type="text" class="form-control" name="color" value="{{ old('color') }}" id="color-form"
                           placeholder="Ex: Blue">
                </div>
                <div class="description-wrapper">
                    <h3>Description</h3>
                </div>
                <div class="line"></div>
                <div class="description-form">
                    <label for="descriptionForm" class="form-label">Description</label>
                    <textarea required class="form-control" name="description" id="description-form"
                              rows="5"></textarea>
                </div>


                <div class="auction-details-wrapper">
                    <h3>Auction Details</h3>
                </div>
                <div class="line"></div>

                <div class="image-form">
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Upload Images</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple name="images[]">
                    </div>
                </div>

                <div class="startingbid-form">
                    <label for="startingbidForm" class="form-label">Starting Bid</label>
                    <input type="number" min="1" class="form-control" name="starting_bid" value="{{ old('starting_bid') }}" id="startingbid-form"
                           placeholder="Ex: 272727">
                </div>
                <label for="durationForm" class="form-label">Duration</label>
                <div class="duration-form d-flex">
                    <input class='duration-input' value="{{ old('d') == null ? 0:old('d')}}" id='d' name='d' type='number' min='0' max='7'>
                    <label class='duration-label' for='d'>d</label>
                    <input class='duration-input' value="{{ old('h') == null ? 0:old('h')}}" id='h' name='h' type='number' min='0' max='23'>
                    <label class='duration-label' for='h'>h</label>
                    <input class='duration-input' value="{{ old('m') == null ? 0:old('m')}}" id='m' name='m' type='number' min='0' max='59'>
                    <label class='duration-label' for='m'>m</label>
                    <input class='duration-input' value="{{ old('s') == null ? 0:old('s')}}" id='s' name='s' type='number' min='0' max='59'>
                    <label class='duration-label' for='s'>s</label>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-outline-danger">
                        Create Auction
                    </button>
                </div>
            </form>

            {{--    TODO: Handle error messages--}}
        </div>
    </div>

@stop
