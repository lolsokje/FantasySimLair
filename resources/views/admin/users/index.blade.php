@extends('layouts.app')

@section('content')
    <h1>Users</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add user</a>

    <table class="table table-dark table-padded mt-5">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->provider_id }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection