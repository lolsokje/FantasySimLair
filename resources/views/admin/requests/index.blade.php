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
            @foreach ($requests as $championshipRequest)
                <tr>
                    <td>{{ $championshipRequest->user->name }}</td>
                    <td>{{ $championshipRequest->channel->name }}</td>
                    <td>{{ $championshipRequest->name }}</td>
                    <td>
                        <form action="{{ route('admin.requests.approve', [$championshipRequest]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="submit" class="btn btn-success" value="Approve">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.requests.reject', [$championshipRequest]) }}" method="POST">
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