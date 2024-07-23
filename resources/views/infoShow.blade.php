@extends('layouts.app')

@section("content")

    <div class="d-flex justify-content-center align-items-start contianer mt-5">
        <div class="ms_card">
            <h1>{{ $flat ->name }}</h1>
            <p>Stanze:{{ $flat ->rooms }}</p>
            <p>{{ $flat ->beds }}</p>
            <p>{{ $flat ->bathrooms }}</p>
            <p>{{ $flat ->square_meters }}</p>
        </div>
    </div>
@endsection