@extends('layouts.app')

@section('content')
    <h1>{{ $season->championship->name }} {{ $season->year }} standings overview</h1>

    @if ($season->wdc_standings)
        <h3>Drivers' championship standings</h3>
        <img src="{{ $season->wdc_standings }}" alt="WDC standings">
    @endif

    @if ($season->wcc_standings)
        <h3>Teams' championship standings</h3>
        <img src="{{ $season->wcc_standings }}" alt="WCC standings">
    @endif

    @if ($season->combined_standings)
        <h3>Combined standings</h3>
        <img src="{{ $season->combined_standings }}" alt="Combined standings">
    @endif
@endsection