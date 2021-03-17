@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Add channel</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.channels.store') }}" method="POST" class="mt-4">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="channel_id">Channel ID</label>
                    <input type="text" name="channel_id" id="channel_id" class="form-control" required>
                </div>

                <input type="submit" class="btn btn-primary mt-2" value="Save">
            </form>
        </div>
    </div>
@endsection