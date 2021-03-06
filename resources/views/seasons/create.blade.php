@extends('layouts.app')

@section('content')
    <div class="card shadow bg-dark">
        <div class="card-header">
            <h1>Add season</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('seasons.store', [$championship]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" id="year" name="year" class="form-control" required>
                    <small>Has to be unique in this championship</small>
                </div>

                <p class="mt-4">All the below fields are optional, if you only have combined standings, enter that field. If you have
                both drivers and constructors/teams standings, use those fields. It's not hard.</p>

                <div class="form-group">
                    <label for="wdc_standings" class="form-label">Drivers' championship standings image link</label>
                    <input type="text" id="wdc_standings" name="wdc_standings" class="form-control">
                </div>

                <div class="form-group mt-4">
                    <label for="wcc_standings" class="form-label">Teams' championship standings image link</label>
                    <input type="text" id="wcc_standings" name="wcc_standings" class="form-control">
                </div>

                <div class="form-group mt-4">
                    <label for="combined_standings" class="form-label">Combined standings</label>
                    <input type="text" id="combined_standings" name="combined_standings" class="form-control">
                </div>

                <input type="submit" class="btn btn-primary mt-4" value="Add season">
            </form>
        </div>
    </div>
@endsection