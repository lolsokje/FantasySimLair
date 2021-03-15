@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Add user</h1>
        </div>
        <div class="card-body">
            <small>Due to Discord's API limitations, it's not possible to fetch all users and store them. Instead you'll
            need to enter a user's ID here, and after submitting an API call will be made to fetch this user's details
            (granted the user exists).</small>

            <form action="{{ route('admin.user.store') }}" method="POST" class="mt-4">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" id="user_id" name="user_id" class="form-control" required>
                </div>

                <input type="submit" class="btn btn-primary mt-2" value="Save">
            </form>
        </div>
    </div>
@endsection