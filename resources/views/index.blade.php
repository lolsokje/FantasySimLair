@extends('layouts.app')

@section('content')
    <h1>All championships</h1>

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Championship</th>
                <th>User</th>
                <th>Channel</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championships as $championship)
                <tr>
                    <td>{{ $championship->name }}</td>
                    <td>{{ $championship->user->name }}</td>
                    <td>{{ $championship->channel->name }}</td>
                    <td><a href="{{ route('championships.show', [$championship]) }}" class="btn btn-primary">Show seasons</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection