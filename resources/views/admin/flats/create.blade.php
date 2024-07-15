@extends('layouts.admin')

@section('content')
<div id="map" class="map"></div>
<!-- Replace version in the URL with desired library version -->
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
<script>
    tt.setProductInfo("<your-product-name>", "<your-product-version>")
    tt.map({
        key: "bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26",
        container: "map",
    })
</script>


<div class="container">
    <h1>Aggiungi un nuovo appartamento</h1>
    <form action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Nome</label><br>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="rooms">Numero di stanze</label><br>
        <input type="number" id="rooms" name="rooms"class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms') }}">
        @error('rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="bathrooms">Numero di bagni</label><br>
        <input type="number" id="bathrooms" name="bathrooms"class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}">
        @error('bathrooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="beds">Numero di letti</label><br>
        <input type="number" id="beds" name="beds"class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}">
        @error('beds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="square_meters">Metri quadri</label><br>
        <input type="number" id="square_meters" name="square_meters" class="form-control @error('square_meters') is-invalid @enderror" value="{{ old('square_meters') }}">
        @error('square_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="address">Indirizzo</label><br>
        <input type="text" id="address" name="address"class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="latitude">latitude</label><br>
        <input type="text" id="latitude" name="latitude"class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
        @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

        <label for="longitude">longitude</label><br>
        <input type="text" id="longitude" name="longitude"class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
        @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        <br>

            <h6>Seleziona i servizi disponibili</h6>
            @foreach ($service as $service)
            <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"> <label for="services[]"> {{ $service->name }}</label>

            @endforeach
           <br> <label for="img_path">Imagine</label><br>
            <input type="file" id="img_path" name="img_path"><br>

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
