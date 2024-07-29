@extends('layouts.admin')

@section('content')
{{-- @dd(Route::currentRouteName()) --}}
    <div class="ms_shadow mt-4 container ms_border p-4">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class=" mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1>Appartamenti</h1>
            </div>
            <div>
                <a class="ms_button" href="{{route('admin.flats.create')}}">&plus; Aggiungi</a>
            </div>
        </div>
        <table class="ms_table table_flats">
            <thead>
                <tr class="ms_tr">
                    <th scope="col">Nome</th>
                    <th scope="col">N° Stanze</th>
                    <th class="tabs" scope="col">N° Bagni</th>
                    <th scope="col">N° Letti</th>
                    <th class="tabs" scope="col">Indirizzo</th>
                    <th class="tabs" scope="col"></th>
                    <th class="tabs" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flatsArray as $item)
                    <tr class="ms_shadow2 flat" data-href="{{ route('admin.flats.show', ['flat' => $item->slug]) }}">
                        <input type="hidden" value="{{ $item->slug }}">
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->rooms }}</td>
                            <td class="tabs">{{ $item->bathrooms }}</td>
                            <td>{{ $item->beds }}</td>
                            <td class="tabs">{{ $item->address }}</td>
                            <td class="tabs">
                                <a href="{{ route('admin.flats.show', ['flat' => $item->slug]) }}"><i class="fa-solid fa-info info ms_button_info d-flex justify-content-center"></i></a>
                            </td>
                            <td class="tabs">
                                <a href="{{ route('admin.sponsor', ['slug' => $item->slug]) }}"><img class="spons ms_button icon" src="{{ asset('Icons/spons.svg') }}" alt=""></a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
