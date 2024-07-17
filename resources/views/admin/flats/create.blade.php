@extends('layouts.admin')

@section('content')
    <div class="container p-5 ms_shadow mt-4 ms_border p-4">
        <h1>Aggiungi un nuovo appartamento</h1>
        <div class="row">
            <div class="col-9">
                <form id='form-create' action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="container p-0 m-0">
                        @csrf
                        <div class="row mb-3">
                            <div class="col ">
                                <div class="">
                                    <label for="name">Nome</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="">
                                    <label for="rooms">Numero di stanze</label>
                                    <input type="number" id="rooms" name="rooms"
                                        class="form-control @error('rooms') is-invalid @enderror"
                                        value="{{ old('rooms') }}">
                                    @error('rooms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="">
                                    <label for="bathrooms">Numero di bagni</label>
                                    <input type="number" id="bathrooms"
                                        name="bathrooms"class="form-control @error('bathrooms') is-invalid @enderror"
                                        value="{{ old('bathrooms') }}">
                                    @error('bathrooms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="">
                                    <label for="beds">Numero di letti</label>
                                    <input type="number" id="beds"
                                        name="beds"class="form-control @error('beds') is-invalid @enderror"
                                        value="{{ old('beds') }}">
                                    @error('beds')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="">
                                    <label for="square_meters">Metri quadri</label>
                                    <input type="number" id="square_meters" name="square_meters"
                                        class="form-control @error('square_meters') is-invalid @enderror"
                                        value="{{ old('square_meters') }}">
                                    @error('square_meters')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                {{-- search-box for address --}}
                                <label class="fomr-label" for="address">Cerca Indirizzo</label>
                                <input value="{{ old('address') }}" name="address" class="form-control" type="text"
                                    id="address">
                                {{-- input hidden latitudine and longitude --}}
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                {{-- list suggestion  --}}
                                <ul id="suggestions"></ul>
                                <div id="search" class="btn btn-primary">Mostra nella mappa</div>
                            </div>
                            <div id="map-create" class="col-6">
                                <div id="map" class="map"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="btn-group" role="group">
                                    <div class="container">
                                        <div class="row">
                                            @foreach ($services as $service)
                                                <div class="col-3">
                                                    @if (old('services') != null)
                                                        <input @checked(in_array($service->id, old('services', []))) value="{{ $service->id }}"
                                                            class="btn-check" type="checkbox" name="services[]"
                                                            id="{{ $service->id }}">
                                                    @else
                                                        <input value="{{ $service->id }}" class="btn-check"
                                                            type="checkbox" name="services[]" id="{{ $service->id }}">
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
                                        <option @selected(old('visible') == '1') value="1">Si</option>
                                        <option @selected(old('visible') == '0')value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary" type="submit">Aggiungi appartamento</button>
                                <a class="btn btn-danger" href="{{ route('admin.dashboard') }}">Annulla</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
