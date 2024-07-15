@extends('layouts.admin')

@section('content')
    <div class="container mt-3">

        {{-- errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Modifica Appartamento</h2>

        {{-- form --}}
        <div class="row">
            <form action="{{ route('admin.flats.update', $flat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- name --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="name">Nome Appartamento</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                {{-- slug --}}
                <div class="my-3 col-12">
                    <label for="slug" class="form-label">Slug</label>
                    <input class="form-control" type="text" name="slug" id="slug">
                </div>

                {{-- rooms --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="rooms">Stanze</label>
                    <input type="number" name="rooms" id="rooms" class="form-control">
                </div>

                {{-- bathrooms --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="bathrooms">Bagni</label>
                    <input class="form-control" type="number" name="bathrooms" id="bathrooms">
                </div>

                {{-- beds --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="beds">Letti</label>
                    <input class="form-control" type="number" name="beds" id="beds">
                </div>

                {{-- square_meters --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="square_meters">Metri Quadrati</label>
                    <input class="form-control" type="number" name="square_meters" id="square_meters">
                </div>

                {{-- address --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="address">Indirizzo</label>
                    <input class="form-control" type="text" name="address" id="address">
                </div>

                {{-- image --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="img_path">Poster</label>
                    <input class="form-control" type="file" name="img_path" id="img_path">
                </div>

                {{-- visible --}}
                <div class="my-3 col-12">
                    <label class="form-label" for="visible">Visibile</label>
                    <select class="form-select" name="visible" id="visible">
                        <option value="">Seleziona</option>
                        <option value="">Si</option>
                        <option value="">No</option>
                    </select>
                </div>


                <button class="btn btn-success mt-3" type="submit">Salva</button>
            </form>

        </div>
    </div>
@endsection
