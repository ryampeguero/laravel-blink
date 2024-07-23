@extends('layouts.admin')

@section('content')
    <div class="container p-5 ms_shadow mt-4 ms_border p-4 mb-5">
        <h1>Modifica appartamento</h1>
        <div class="row">
            <div class="col-6 mt-5">
                <form class="px-4" id='form-edit' action="{{ route('admin.flats.update', ['flat' => $flat->slug]) }}"
                    method="POST" enctype="multipart/form-data" autocomplete="off" name="theForm">
                    @method('PUT')
                    <div class="container-fluid p-0 m-0">
                        @csrf
                        <div class="row mb-3">
                            <div class="col ">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $flat->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="rooms">Numero di stanze</label>
                            @error('rooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div id='rooms' class="ms_input">
                                <input id='input_value' type="hidden" name="rooms"
                                    value="{{ old('rooms', $flat->rooms) }}">
                                <button id="minus" class="input_btn">-</button>
                                <span id="ms_value">0</span>
                                <button id="plus" class="input_btn">+</button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="">
                                <label for="bathrooms">Numero di bagni</label>


                                <div id='bathrooms' class="ms_input">
                                    <input id='input_value' type="hidden" name="bathrooms"
                                        value="{{ old('bathrooms', $flat->bathrooms) }}">
                                    <button id="minus" class="input_btn">-</button>
                                    <span id="ms_value">0</span>
                                    <button id="plus" class="input_btn">+</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">

                        <div class="col-6">
                            <div class="">
                                <label for="beds">Numero di letti</label>
                                <input type="number" id="beds"
                                    name="beds"class="form-control @error('beds') is-invalid @enderror"
                                    value="{{ old('beds', $flat->beds) }}">
                                @error('beds')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="">
                                <label for="square_meters">Metri quadri</label>
                                <input type="number" id="square_meters" name="square_meters"
                                    class="form-control @error('square_meters') is-invalid @enderror"
                                    value="{{ old('square_meters', $flat->square_meters) }}">
                                @error('square_meters')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{-- search-box for address --}}
                            <div id="search-bar" class="">
                                <label class="form-label" for="address">Cerca Indirizzo</label>
                                <input value="{{ old('address', $flat->address) }}" name="address" class="form-control"
                                    type="text" id="address" autocomplete="off">
                                {{-- input hidden latitudine and longitude --}}
                                <button id="search-btn" class="btn btn-outline-primary">Cerca</button>
                            </div>

                            <input type="hidden" name="latitude" id="latitude"
                                value="{{ old('latitude', $flat->latitude) }}">
                            <input type="hidden" name="longitude" id="longitude"
                                value="{{ old('longitude', $flat->longitude) }}">
                            {{-- list suggestion  --}}
                            <ul id="suggestions"></ul>
                        </div>
                    </div>

                    <div class="row">
                        <div id="map-create" class="col-12">
                            <div id="map" class="map"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h4>Filtra gli optional della tua stanza</h4>
                            <div class="btn-group" role="group">
                                <div class="">
                                    <div class="d-flex flex-wrap gap-2 ">
                                        @foreach ($services as $service)
                                            <div class="p-1">


                                                @if (old('services') != null)
                                                    <input @checked(in_array($service->id, old('services', []))) value="{{ $service->id }}"
                                                        class="btn-check" type="checkbox" name="services[]"
                                                        id="{{ $service->id }}">
                                                @else
                                                    <input @checked($flat->services->contains($service->id)) value="{{ $service->id }}"
                                                        class="btn-check" type="checkbox" name="services[]"
                                                        id="{{ $service->id }}">
                                                @endif
                                                <label style="font-size: 0.8rem"
                                                    class="form-label btn btn-outline-primary test"
                                                    for="{{ $service->id }}">{{ $service?->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="img_path">Immagine</label>
                            <input class="form-control" type="file" id="img_path" name="img_path">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col prova">
                            <div class="my-3 col-12">
                                <label class="form-label" for="visible">Visibile*</label>
                                <select class="form-select" name="visible" id="visible">
                                    <option value="">Seleziona</option>
                                    <option @selected(old('visible', $flat->visible) == '1') value="1">Si</option>
                                    <option @selected(old('visible', $flat->visible) == '0')value="0">No</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-between">
                            <a class="ms_button_secondary" href="{{ route('admin.dashboard') }}">Annulla</a>
                            <button class="ms_button" type="submit">Salva Modifica</button>
                        </div>
                    </div>
            </div>
            </form>
            
            <div class="col-6 mt-5 ms_border_inner">
                <img class="ms_img ms_border_inner" src="{{ asset('img/placeholder_img_fit.png') }}" alt="">
            </div>
            
        </div>
    </div>
@endsection