@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Add championships</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.championships.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Select user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->provider_id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="channel_id">Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control" required>
                        <option value="">Select channel</option>
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Championship name" required>
                </div>

                <input type="submit" value="Add championship" class="btn btn-primary mt-4">
            </form>
        </div>
    </div>
@endsection