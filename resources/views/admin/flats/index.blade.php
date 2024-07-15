@extends('layouts.admin')

@section('content')
{{-- @dd(Route::currentRouteName()) --}}
    <div class="ms_shadow mt-4 container ms_border p-4 ">
        <div class=" mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1>Appartamenti</h1>
            </div>
            <div>
                <a class="ms_button" href="{{route('admin.flats.create')}}">&plus; Aggiungi</a>
            </div>
        </div>
        <div class="justify-content-between mb-3 gap-3 stats">
            <div class="container-fluid ms_border_inner p-4 ms_shadow">
                <h4>Stats</h4>
                <h1>5264</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="container-fluid ms_border_inner p-4 ms_shadow">
                <h4>Stats</h4>
                <h1>1820</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class=" container-fluid ms_border_inner p-4 ms_shadow">
                <h4>Stats</h4>
                <h1>3212</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <table class="ms_table">
            <thead>
                <tr class="ms_tr">
                    <th class="tabs" scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">N° Stanze</th>
                    <th class="tabs" scope="col">N° Bagni</th>
                    <th scope="col">N° Letti</th>
                    <th class="tabs" scope="col">Indirizzo</th>
                    <th class="tabs" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flatsArray as $item)
                    <tr class="ms_shadow2 test" data-href="{{ route('admin.flats.show', ['flat' => $item->slug]) }}">
                        <input type="hidden" value="{{ $item->slug }}">
                            <th class="tabs" scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->rooms }}</td>
                            <td class="tabs">{{ $item->bathrooms }}</td>
                            <td>{{ $item->beds }}</td>
                            <td class="tabs">{{ $item->address }}</td>
                            <td class="tabs">
                                <a href="{{ route('admin.flats.show', ['flat' => $item->slug]) }}">INFO</a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
