@extends('layouts.app')

@section('content')
    @if ($apartment)
        <div class="row">
            @if ($apartment->uploaded_image)
                <div class="col">
                    <img src="{{ asset('storage/' . $apartment->uploaded_image) }}" alt="{{ $apartment->title }}" class="card-img">
                </div>
            @else
                <div class="col">
                    <img src="{{ $apartment->picture }}" class="card-img" alt="{{ $apartment->title }}">
                </div>
            @endif
                <div class="col">
                    <h5 class="card-title">Apartment name: {{ $apartment->title }}</h5>
                    <div class="card-text">Rooms: {{ $apartment->n_rooms }}</div>
                    <div class="card-text">Beds: {{ $apartment->n_beds }}</div>
                    <div class="card-text">Bathrooms: {{ $apartment->n_bathrooms }}</div>
                    <div class="card-text">Mq: {{ $apartment->square_meters }}</div>
                    <div class="card-text">Latitude: {{ $apartment->latitude }}</div>
                    <div class="card-text">Longitude: {{ $apartment->longitude }}</div>
                    <div class="card-text">State: {{ $apartment->state }}</div>
                    <div class="card-text">City: {{ $apartment->city }}</div>
                    <div class="card-text">Address: {{ $apartment->address }}</div>
                    <div class="card-text">Apartment number: {{ $apartment->apartment_number }}</div>
                    <div class="card-text">Services:
                        @if ($apartment->services->all())
                            <div>
                                @foreach ($apartment->services as $service)
                                    {{ $service->name }}{{ $loop->last ? '' : ', ' }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            {{-- <div id="map" class="map mt-3" style='width: 100%; height: 600px; border-radius: 10px;'></div> --}}
        </div>
    @else
        <div>
            <img class="d-flex m-auto" src="https://media.tenor.com/OTzJy4d4xGMAAAAC/computer-stick-man.gif" alt="gif">
        </div>
    @endif

    <div class="controls mt-3">
        <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}" class="btn btn-warning">Edit</a>
        <button class="btn btn-danger btn_delete" data-id="{{ $apartment->slug}}">Delete</button>
        <a href="{{ route('admin.apartments.index', ['apartment' => $apartment]) }}" class="btn btn-info" data-id="{{ $apartment->slug}}">Turn back</a>
    </div>

    @include('admin.partials.delete_confirmation', [
        'delete_name' => 'apartment',
    ])
@endsection
