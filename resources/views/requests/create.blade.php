@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Request championship</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('requests.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="channel_id" class="form-label">Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control" required>
                        <option value="">Select channel</option>
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <input type="submit" class="btn btn-primary mt-4" value="Save request">
            </form>
        </div>
    </div>
@endsection