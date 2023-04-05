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

    <form method="post" action="{{ route('admin.messages.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <input type="text" class="form-control @error('message') is-invalid @enderror" id="message" name="message" value="{{ old('message') }}">
            @error('message')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('message') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" name="date"  value="{{ old('date') }}">
            @error('date')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('date') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
