@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.apartments.update', ['apartment' => $apartment]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- TITLE section --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $apartment->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('title') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- SLUG section TODO: VEDERE SE RIMUOVENDO LO SLUG DAL CREATE CI SONO PROBLEMI --}}
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"  value="{{ old('slug', $apartment->slug) }}">
            @error('slug')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('slug') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- UPLOADED IMAGE section --}}
        <div class="mb-3">
            <label for="uploaded_image" class="form-label">Uploaded Image</label>
            <input class="form-control @error('uploaded_image') is-invalid @enderror" type="file" id="uploaded_image" name="uploaded_image">
            <div class="invalid-feedback">
                @error('uploaded_image')
                    <ul>
                        @foreach ($errors->get('uploaded_image') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- ROOMS section --}}
        <div class="mb-3">
            <label for="n_rooms" class="form-label">Rooms</label>
            <input type="number" class="form-control @error('n_rooms') is-invalid @enderror" id="n_rooms" name="n_rooms" value="{{ old('n_rooms', $apartment->n_rooms) }}">
            @error('n_rooms')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('n_rooms') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- BEDS section --}}
        <div class="mb-3">
            <label for="n_beds" class="form-label">Beds</label>
            <input type="number" class="form-control @error('n_beds') is-invalid @enderror" id="n_beds" name="n_beds" value="{{ old('n_beds', $apartment->n_beds) }}">
            @error('n_beds')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('n_beds') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- BATHS section --}}
        <div class="mb-3">
            <label for="n_bathrooms" class="form-label">Bathrooms</label>
            <input type="number" class="form-control @error('n_bathrooms') is-invalid @enderror" id="n_bathrooms" name="n_bathrooms" value="{{ old('n_bathrooms', $apartment->n_bathrooms) }}">
            @error('n_bathrooms')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('n_bathrooms') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- SQUEARE METERS section --}}
        <div class="mb-3">
            <label for="square_meters" class="form-label">Square Meters</label>
            <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
            @error('square_meters')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('square_meters') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- STATE section --}}
        <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $apartment->state) }}">
            @error('state')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('state') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- CITY section --}}
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $apartment->city) }}">
            @error('city')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('city') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- ADDRESS section --}}
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $apartment->address) }}">
            @error('address')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('address') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- HOUSE NUMBER section --}}
        <div class="mb-3">
            <label for="apartment_number" class="form-label">House Number</label>
            <input type="number" class="form-control @error('apartment_number') is-invalid @enderror" id="apartment_number" name="apartment_number" value="{{ old('apartment_number', $apartment->apartment_number) }}">
            @error('apartment_number')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('apartment_number') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        {{-- SERVICES section --}}
        <div class="col-12">
            <h5>Services</h5>
            <p>Udate the types of services available in your offer</p>
            @foreach ($services as $service)
                <div class="form-check">
                    <input
                        id="service-{{ $service->id }}"
                        class="form-check-input @error('services.') is-invalid @enderror"
                        type="checkbox"
                        value="{{ $service->id }}"
                        name="services[]"
                        @if (in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif
                    >
                    <label class="form-check-label" for="service-{{ $service->id }}">
                        {{ $service->name }}
                    </label>
                    <div class="invalid-feedback">
                        @error('services.')
                            <ul>
                                @foreach ($errors->get('services.*') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
