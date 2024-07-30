@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="d-none" id="message">

        </div>
        <div class="row w-100">
            <div class="col ms_shadow ms_border p-2">
                <div class="p-2">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title">{{ $flat->name }}</h2>
                        <div class="d-flex gap-3">
                            <div class="">
                                <a href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}"
                                    class="btn btn-warning"><i class="fa-solid fa-pen"></i>
                                </a>
                            </div>
                            <div class="">
                                <form class="delete-form"
                                    action="{{ route('admin.flats.destroy', ['flat' => $flat->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btnDeleteFlat" data-flat-name="{{ $flat->name }}" type="submit"
                                        class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h3>Visite: <span>{{ $views }}</span></h3>
                    </div>
                </div>
                <div class="container-fluid w-100 ">
                    <div class="row">
                        <div class="col-md-6 border-gray">
                            <div class="">
                                @if ($flat->img_path)
                                    <img src="{{ asset('storage/' . $flat->img_path) }}" class="img-fluid mt-3"
                                        alt="Immagine Appartamento">
                                @else
                                    <img src="https://www.italianofishingshop.com/pimages/RETE-MT-5-IDROSOLUBILE-NERA-small-4632.jpg"
                                        alt="imgNotAvailable">
                                @endif
                                <h5><strong>Indirizzo:</strong> {{ $flat->address }}</h5>
                            </div>
                            <div class="scroller">
                                <table class="ms_table">
                                    <thead>
                                        <tr class="ms_tr">
                                            <th scope="col">Email</th>
                                            <th class="message" scope="col">Messaggio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ $message->message }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 border-gray pt-3">
                            <div class="container-fluid w-100">
                                <div class="row">
                                    <div class="col">
                                        <h4>Dettagli: </h4>
                                        <div><i class="fa-solid fa-person-shelter"></i> Stanze: {{ $flat->rooms }}</div>
                                        <div><i class="fa-solid fa-bed"></i> Letti: {{ $flat->beds }}</div>
                                        <div><i class="fa-solid fa-bath"></i> Bagni: {{ $flat->bathrooms }}</div>
                                        <div><i class="fa-solid fa-ruler"></i> Metri: {{ $flat->square_meters }} &#13217;
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4>Servizi: </h4>
                                        @foreach ($flat->services as $service)
                                            <div class="">
                                                <i class="fa-solid {{ $service->icon }}"></i>
                                                <span class="sm-text">{{ $service->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col p-3">
                                    <span id="lat" php-var={{ $flat->latitude }}></span>
                                    <span id="lon" php-var={{ $flat->longitude }}></span>
                                    <div id="map" class="map-show"></div>
                                </div>
                            </div>
                            <div class="row pt-5">
                                <div class="col">
                                    {{ $messages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between p-2">
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
