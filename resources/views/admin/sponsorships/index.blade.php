@extends('layouts.app')

@section('content')
    <h1>Sponsorships apartments</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Sponsor Time</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($sponsorships as $sponsorship)
                <tr>
                    <th scope="row">{{ $sponsorship->id }}</th>
                    <td>{{ $sponsorship->type }}</td>
                    <td>{{ $sponsorship->price }} €</td>
                    <td>{{ $sponsorship->sponsor_time }} hours</td>
                    <td><a href="{{ route('admin.sponsorships.show', ['value' => $sponsorship->type]) }}" class="btn btn-primary">Buy</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-info">Back to apartment</a>
    </div>
@endsection
