@extends('layouts.app')

@section('content')
    <h1>{{ $championship->name }} seasons</h1>

    <a href="{{ route('seasons.create', [$championship]) }}" class="btn btn-primary">Add season</a>

    <table class="table table-dark mt-4">
        <thead>
            <tr>
                <th>Year</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championship->seasons as $season)
                <tr>
                    <td class="align-middle">{{ $season->year }}</td>
                    <!-- @todo policies? -->
                    <td>
                        <a href="{{ route('seasons.show', [$season]) }}" class="btn btn-primary">View</a>
                    </td>
                    <td>
                        <a href="{{ route('seasons.edit', [$season]) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection