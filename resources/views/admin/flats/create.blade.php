@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Aggiungi un nuovo appartamento</h1>
        <form id='form-create' action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nome</label><br>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <label for="rooms">Numero di stanze</label><br>
            <input type="number" id="rooms" name="rooms"class="form-control @error('rooms') is-invalid @enderror"
                value="{{ old('rooms') }}">
            @error('rooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <label for="bathrooms">Numero di bagni</label><br>
            <input type="number" id="bathrooms"
                name="bathrooms"class="form-control @error('bathrooms') is-invalid @enderror"
                value="{{ old('bathrooms') }}">
            @error('bathrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <label for="beds">Numero di letti</label><br>
            <input type="number" id="beds" name="beds"class="form-control @error('beds') is-invalid @enderror"
                value="{{ old('beds') }}">
            @error('beds')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <label for="square_meters">Metri quadri</label><br>
            <input type="number" id="square_meters" name="square_meters"
                class="form-control @error('square_meters') is-invalid @enderror" value="{{ old('square_meters') }}">
            @error('square_meters')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <label for="address">Indirizzo</label><br>
            <input type="text" id="address" name="address"class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <br>

            <div class="container" style="height: 400px">
                <div class="row h-100">
                    <div class="col-6">
                        <div class="">
                            <label for="address">Numero Civico</label><br>
                            <input type="number" id="streetNumber"
                            name="streetNumber"class="form-control @error('streetNumber') is-invalid @enderror"
                            value="{{ old('municipality') }}">
                        </div>
                        <div class="">
                            <label for="address">Comune</label><br>
                            <input type="text" id="municipality"
                            name="municipality"class="form-control @error('municipality') is-invalid @enderror"
                            value="{{ old('address') }}">
                        </div>
                        <div class="">
                            <label for="address">Codice Postale</label><br>
                            <input type="text" id="postalCode"
                            name="address"class="form-control @error('municipality') is-invalid @enderror"
                            value="{{ old('municipality') }}">
                        </div>
                    </div>
                    <div id="map-create" class="col-6" >
                        <div id="map" class="map"></div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary">Mostra preview</button>
                </div>
            </div>

            <div class="mt-5">
                <h6>Seleziona i servizi disponibili</h6>
                @foreach ($service as $service)
                <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                <label for="services[]"> {{ $service->name }}</label>
                @endforeach
                <br> <label for="img_path">Imagine</label><br>
                <input type="file" id="img_path" name="img_path"><br>
            </div>
                
                <br> <label for="address">Vuoi mettere in vendita subito il tuo appartamento</label><br>
            <input type="radio" id="true" name="visible" value="1">
            <label for="true">Si, voglio inserirlo ora</label><br>
            <input type="radio" id="false" name="visible" value="0">
            <label for="false">No, provvedrò dopo</label><br>


            <br> <button type="submit">Aggiungi appartamento</button><br>
            <a href="{{ route('admin.dashboard') }}">Annulla</a>
        </form>
    </div>
@endsection
