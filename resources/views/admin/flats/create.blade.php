@extends('layouts.admin')

@section('content')
    <div class="container p-3 ms_shadow mt-4 ms_border p-4 mb-5">
        <h1>Aggiungi un nuovo appartamento</h1>
        <div class="row">
            <!-- Colonna del modulo -->
            <div class=" mt-5 p-0">
                <form class="px-2" id='form-create' action="{{ route('admin.flats.store') }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="container-fluid p-0 m-0">
                        <!-- Nome -->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Numero di stanze e bagni -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="rooms">Numero di stanze</label>
                                @error('rooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id='rooms' class="ms_input">
                                    <input id='input_value' type="hidden" name="rooms" value="{{ old('rooms', '1') }}">
                                    <button id="minus" class="input_btn">-</button>
                                    <span id="ms_value"></span>
                                    <button id="plus" class="input_btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="bathrooms">Numero di bagni</label>
                                <div id='bathrooms' class="ms_input">
                                    <input id='input_value' type="hidden" name="bathrooms"
                                        value="{{ old('bathrooms', '1') }}">
                                    <button id="minus" class="input_btn">-</button>
                                    <span id="ms_value"></span>
                                    <button id="plus" class="input_btn">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Numero di letti e metri quadri -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="beds">Numero di letti</label>
                                <input type="number" id="beds" name="beds"
                                    class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}">
                                @error('beds')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="square_meters">Metri quadrati</label>
                                <input type="number" id="square_meters" name="square_meters"
                                    class="form-control @error('square_meters') is-invalid @enderror"
                                    value="{{ old('square_meters') }}">
                                @error('square_meters')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Indirizzo e mappa -->
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="address">Cerca Indirizzo</label>
                                <input value="{{ old('address') }}" name="address" class="form-control" type="text"
                                    id="address" autocomplete="off">
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <ul id="suggestions"></ul>
                                <div class="w-25 text-center">
                                    <div id="search" class="ms_button">Mostra nella mappa</div>
                                </div>
                            </div>
                        </div>

                        <!-- Mappa -->
                        <div class="row mb-3">
                            <div id="map-create" class="col-12">
                                <div id="map" class="map"></div>
                            </div>
                        </div>

                        <!-- Optional -->
                        <div class="row mb-3">
                            <div class="col">
                                <h4>Optional</h4>

                                <div class="btn-group " role="group">
                                    <div class="">
                                        <div class="d-flex flex-wrap gap-2 ">
                                            @foreach ($services as $service)
                                                <div class="p-1">
                                                    @if (old('services') != null)
                                                        <input @checked(in_array($service->id, old('services', []))) value="{{ $service->id }}"
                                                            class="btn-check" type="checkbox" name="services[]"
                                                            id="{{ $service->id }}">
                                                    @else
                                                        <input value="{{ $service->id }}" class="btn-check"
                                                            type="checkbox" name="services[]" id="{{ $service->id }}">
                                                    @endif
                                                    <label style="font-size: 0.8rem"
                                                        class="form-label btn btn-outline-primary test "
                                                        for="{{ $service->id }}"><i class="fa-solid {{$service->icon}}"></i></label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Immagine -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="img_path">Immagine</label>
                                    <input class="form-control" type="file" id="img_path" name="img_path">
                                </div>
                            </div>

                            <!-- Visibilità -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="visible">Visibile*</label>
                                    <select class="form-select" name="visible" id="visible">
                                        <option value="">Seleziona</option>
                                        <option @selected(old('visible') == '1') value="1">Si</option>
                                        <option @selected(old('visible') == '0') value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Pulsanti -->
                            <div class="row">
                                <div class="col d-flex justify-content-between gap-1">
                                    <a class="ms_button_secondary " href="{{ route('admin.dashboard') }}">Annulla</a>
                                    <button class="ms_button" type="submit">Aggiungi</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>

        <!-- Colonna dell'immagine -->
    </div>
    </div>
@endsection
