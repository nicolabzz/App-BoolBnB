@extends('layouts.app')

@section('content')
<h1>{{ Auth::user()->name }}'s messages</h1>
    @if($messages->isEmpty())
        <p>No messages to display</p>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-info">Back to dashboard</a>
        </div>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Apartment name</th>
                <th scope="col">Owner</th>
                <th scope="col">Address</th>
                <th scope="col">City</th>
                <th scope="col">Messages</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apartments as $apartment)
                <tr>
                    <th scope="row">{{ $apartment->title }}</th>
                    <td>{{ $apartment->user->name }}</td>
                    <td>{{ $apartment->address }}</td>
                    <td>{{ $apartment->city }}</td>
                    <td>
                        <ul>
                            @foreach ($apartment->messages as $message)
                                <li>{{ $message->message }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <button class="btn btn-danger btn_delete" data-id="{{ $apartment->slug}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @if ($messages->isEmpty())
        <p></p>
    @else
    {{ $messages->links() }}
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-info" data-id="{{ $apartment->slug}}">Back to dashboard</a>
        </div>
    @endif

    @include('admin.partials.delete_confirmation', [
        'delete_name' => 'apartment',
    ])
@endsection
