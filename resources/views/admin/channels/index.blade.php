@extends('layouts.app')

@section('content')
    <h1>Channels</h1>

    <a href="{{ route('admin.channels.create') }}" class="btn btn-primary">Add channel</a>

    <table class="table table-dark table-padded mt-5">
        <thead>
        <tr>
            <th>Channel ID</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($channels as $channel)
            <tr>
                <td>{{ $channel->id }}</td>
                <td>{{ $channel->name }}</td>
                <td>
                    <form action="{{ route('admin.channels.destroy', ['channel' => $channel]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="DELETE">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection