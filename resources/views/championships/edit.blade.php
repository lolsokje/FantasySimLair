@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Update championships</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('championships.update', [$championship]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $championship->name }}" required>
                </div>

                <input type="submit" class="btn btn-primary mt-4" value="Update championship">
            </form>
        </div>
    </div>
@endsection