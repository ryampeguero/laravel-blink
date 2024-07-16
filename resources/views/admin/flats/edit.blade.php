@extends('layouts.admin')

@section('content')
    <div class="container mt-3">

        {{-- errors --}}
        @include('partials.errors')

        <h2>Modifica Appartamento</h2>

        {{-- form --}}
        <div class="row">
            <form action="{{ route('admin.flats.update', $flat) }}" method="POST" id="form-edit" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- name --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="name">Nome Appartamento*</label>
                    <input value="{{ old('name') ?? $flat->name }}" type="text" name="name" id="name"
                        class="form-control">
                </div>

                {{-- slug --}}
                <div class="my-3 col-12">
                    <label for="slug" class="form-label">Slug*</label>
                    <input value="{{ old('slug') ?? $flat->slug }}" class="form-control" type="text" name="slug"
                        id="slug">
                </div>

                {{-- rooms --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="rooms">Stanze*</label>
                    <input value="{{ old('slug') ?? $flat->rooms }}" type="number" name="rooms" id="rooms"
                        class="form-control">
                </div>

                {{-- bathrooms --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="bathrooms">Bagni*</label>
                    <input value="{{ old('bathrooms') ?? $flat->bathrooms }}" class="form-control" type="number"
                        name="bathrooms" id="bathrooms">
                </div>

                {{-- beds --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="beds">Letti*</label>
                    <input value="{{ old('beds') ?? $flat->beds }}" class="form-control" type="number" name="beds"
                        id="beds">
                </div>

                {{-- square_meters --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="square_meters">Metri Quadrati*</label>
                    <input value="{{ old('square_meters') ?? $flat->square_meters }}" class="form-control" type="number"
                        name="square_meters" id="square_meters">
                </div>

                {{-- address --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="address">Indirizzo*</label>
                    <input value="{{ old('address') ?? $flat->address }}" class="form-control" type="text" name="address"
                        id="address">
                </div>

                {{-- image --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="img_path">Poster</label>
                    <input value="{{ old('img_path') ?? $flat->img_path }}" class="form-control" type="file"
                        name="img_path" id="img_path">
                </div>

                {{-- services --}}
                <div class="my-3 col-12">
                    {{-- <p>Seleziona Servizi</p> --}}
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($services as $service)
                            @if (old('services') != null)
                            <input  @checked(in_array($service->id, old('services', [] ))) value="{{ $service->id }}" class="btn-check" type="checkbox" name="services[]" id="{{ $service->id }}">
                            @else
                                <input value="{{ $service->id }}"  class="btn-check" type="checkbox" name="services[]" id="{{ $service->id }}">
                            @endif
                            <label class="form-label btn btn-outline-primary" for="{{ $service->id }}">{{ $service?->name }}</label>
                        @endforeach
                    </div>
                </div>

                {{-- visible --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="visible">Visibile*</label>
                    <select class="form-select" name="visible" id="visible">
                        <option value="">Seleziona</option>
                        <option @selected(old('visible', $flat->visible) == $flat->visible) value="1">Si</option>
                        <option @selected(old('visible', $flat->visible) == $flat->visible) value="0">No</option>
                    </select>
                </div>


                <button class="btn btn-success mt-3" type="submit">Salva</button>
            </form>

        </div>
    </div>
@endsection
