@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Aggiungi un nuovo appartamento</h1>
    <form action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Nome</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="rooms">Numero di stanze</label><br>
        <input type="number" id="rooms" name="rooms"><br>

        <label for="bathrooms">Numero di bagni</label><br>
        <input type="number" id="bathrooms" name="bathrooms"><br>

        <label for="beds">Numero di letti</label><br>
        <input type="number" id="beds" name="beds"><br>

        <label for="square_meters">Metri quadri</label><br>
        <input type="number" id="square_meters" name="square_meters"><br>

        <label for="address">Indirizzo</label><br>
        <input type="text" id="address" name="address"><br>

        <label for="latitude">latitude</label><br>
        <input type="text" id="latitude" name="latitude"><br>

        <label for="longitude">longitude</label><br>
        <input type="text" id="longitude" name="longitude"><br>

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
