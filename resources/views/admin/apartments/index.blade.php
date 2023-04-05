@extends('layouts.app')

@section('content')
    <h1>{{ Auth::user()->name }}'s apartments</h1>


    @if($apartments->isEmpty())
            <p>Your dashboard is empty, <a href="{{ route('admin.apartments.create') }}">click here to create!</a></p>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info">Back to dashboard</a>
            </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Services</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <th scope="row">{{ $apartment->id }}</th>
                        <td>{{ $apartment->title }}</td>
                        <td>
                            @foreach ($apartment->services as $service)
                                {{ $service->name }}{{ $loop->last ? '' : ', ' }}
                            @endforeach
                        </td>
                        <td>
                            <div class="mb-3 form-check form-switch">
                                <input class="form-check-input" checked type="checkbox" role="switch" id="flexSwitchCheckChecked" @error('visibility') is-invalid @enderror id="visibility" name="visibility"  value="{{ old('visibility', $apartment->visibility) }}">
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                @error('visibility')
                                    <div class="invalid-feedback">
                                        <ul>
                                            @foreach ($errors->get('visibility') as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger btn_delete" data-id="{{ $apartment->slug}}">Delete</button>
                            <a href="{{ route('admin.sponsorships.index', ['apartment' => $apartment]) }}" class="btn btn-info mx-5">Boost</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    {{ $apartments->links() }}


    @if ($apartments->isEmpty())
        <p></p>
    @else
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-info" data-id="{{ $apartment->slug}}">Back to dashboard</a>
        </div>
    @endif


    @include('admin.partials.delete_confirmation', [
        'delete_name' => 'apartment',
    ])
@endsection
