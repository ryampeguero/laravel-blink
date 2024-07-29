@extends('layouts.admin')

@section('content')
    <div class="container mt-4">


        <div class="d-none" id="message">

        </div>


        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2 class="card-title">{{ $flat->name }}</h2>
                    <div class="d-flex gap-3">
                        <div class="">
                            <a href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                        <div class="">
                            <form class="delete-form" action="{{ route('admin.flats.destroy', ['flat' => $flat->slug]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="btnDeleteFlat" data-flat-name="{{ $flat->name }}" type="submit"
                                    class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <h3>Visite: <span>{{ $views }}</span></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if ($flat->img_path)
                            <img src="{{ asset('storage/' . $flat->img_path) }}" class="img-fluid mt-3"
                                alt="Immagine Appartamento">
                        @else
                            <img src="https://www.italianofishingshop.com/pimages/RETE-MT-5-IDROSOLUBILE-NERA-small-4632.jpg"
                                alt="imgNotAvailable">
                        @endif

                        <p><strong>Numero di Stanze:</strong> {{ $flat->rooms }}</p>
                        <p><strong>Numero di Bagni:</strong> {{ $flat->bathrooms }}</p>
                        <p><strong>Numero di Letti:</strong> {{ $flat->beds }}</p>
                        <p><strong>Metri quadrati:</strong> {{ $flat->square_meters }}</p>
                        <p><strong>Indirizzo:</strong> {{ $flat->address }}</p>
                    </div>
                    <div class="col-md-6">

                        <div>
                            <p><strong>Descrizione:</strong></p>
                            <p>{{ $flat->description }}</p>
                        </div>
                        <div class="">
                            @foreach ($flat->services as $service)
                                <i class="fa-solid {{ $service->icon }}"></i>
                            @endforeach
                        </div>

                        <span id="lat" php-var={{ $flat->latitude }}></span>
                        <span id="lon" php-var={{ $flat->longitude }}></span>
                        <div id="map" class="map"></div>

                        {{-- Placeholders --}}

                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <div class="">
                    <a href="{{ route('admin.flats.index') }}">
                        <img class="spons ms_button_secondary icon" src="{{ asset('Icons/chevron-left.svg') }}"
                            alt="">
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('admin.sponsor', ['slug' => $flat->slug]) }}">
                        <img class="spons ms_button icon" src="{{ asset('Icons/spons.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        let latCoord = parseFloat(@json($flat->latitude));
        let lonCoord = parseFloat(@json($flat->longitude));

        console.log(latCoord, typeof(latCoord));
        console.log(lonCoord, typeof(lonCoord));
        const position = {
            lat: latCoord,
            lon: lonCoord
        }


        var map = tt.map({ //Setting coordinates to map in View
            key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
            container: 'map',
            center: position,
            zoom: 12
        });
    </script>
@endsection
