@extends('layouts.app')

@section('content')
    <h1>Championship requests</h1>

    <table class="table table-dark table-padded mt-4">
        <thead>
            <tr>
                <th>Requested by</th>
                <th>Channel</th>
                <th>Name</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $channelRequest)
                <tr>
                    <td>{{ $channelRequest->user->name }}</td>
                    <td>{{ $channelRequest->channel->name }}</td>
                    <td>{{ $channelRequest->name }}</td>
                    <td>
                        <form action="{{ route('admin.requests.approve', [$channelRequest]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="submit" class="btn btn-success" value="Approve">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.requests.reject', [$channelRequest]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="submit" class="btn btn-danger" value="Reject">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection