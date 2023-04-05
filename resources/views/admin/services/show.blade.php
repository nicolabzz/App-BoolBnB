@extends('layouts.app')

@section('content')
    <h1>Service: {{ $service->name }}</h1>

    <div class="controls mt-3">
        <a href="{{ route('admin.services.index', ['service' => $service]) }}" class="btn btn-info" data-id="{{ $service->slug}}">Turn back</a>
    </div>
@endsection
