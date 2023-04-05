@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <th scope="row">{{ $service->name }}</th>
                    <td>
                        <a href="{{ route('admin.services.show', ['service' => $service ]) }}" class="btn btn-primary">Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
