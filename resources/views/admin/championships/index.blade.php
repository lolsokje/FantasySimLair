@extends('layouts.app')

@section('content')
    <h1>Championships</h1>

    <a href="{{ route('admin.championships.create') }}" class="btn btn-primary">Add championship</a>

    <table class="table table-dark table-padded mt-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>User</th>
                <th>Channel</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championships as $championship)
                <tr>
                    <td>{{ $championship->name }}</td>
                    <td>{{ $championship->user->name }}</td>
                    <td>{{ $championship->channel->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection