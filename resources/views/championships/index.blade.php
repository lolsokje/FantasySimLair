@extends('layouts.app')

@section('content')
    <h1>My championships</h1>

    <table class="table table-dark mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Channel</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championships as $championship)
                <tr>
                    <td>{{ $championship->name }}</td>
                    <td>{{ $championship->channel->name }}</td>
                    <td><a href="{{ route('championships.show', [$championship]) }}" class="btn btn-primary">Show seasons</a></td>
                    <td>
                        @can('update', $championship)
                            <a href="{{ route('championships.edit', [$championship]) }}" class="btn btn-primary">Edit championship</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection