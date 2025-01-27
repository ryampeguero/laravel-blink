@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1>Dashboard</h1>
    </div>
    <div class="container mt-4">
        <div class="rox mb-4">
            <div class="col">
                <div class="card border-0 d-flex align-items-center">
                    @if ($user->img_path)
                        <img class="icon_profile" src="{{ asset('storage/' . $user->img_path) }}" alt="...">
                    @else
                        <img class="icon_profile" src="{{ asset('img/user_placeholder.png') }}" alt="">
                    @endif
                    <div class="card-body">
                        <h2>Benvenut* {{ ucwords($user->name) }}!</h2>
                        {{-- <p class="card-text"><strong>Email: </strong>{{ $user->email }}</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-3">
            <div class="col">
                <div class="container-fluid ms_card p-4 h-100">
                    <h4>Visualizzazioni Totali</h4>
                    <h1>{{ count($views) }}</h1>
                    <p>Viene aggiornato ad ogni visita da parte di utenti esterni</p>
                </div>
            </div>
            <div class="col">
                <div class="container-fluid ms_card p-4 h-100">
                    <h4>Messaggi Ricevuti</h4>
                    <h1>{{count($messages)}}</h1>
                    <p>Viene aggiornato ad ogni messaggio ricevuto</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ms_shadow mt-4 container ms_border p-4">
        {{-- <div class="">{{ $flats->links() }}</div> --}}
        <div class=" mb-1 d-flex justify-content-between align-items-center">
            <div>
                <h1>Messaggi</h1>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}

            </div>
        @endif
        <div class="">
            {{ $messages->links() }}
        </div>
        
        <div class="scroller">

            <table class="ms_table table_mex">
                <thead>
                    <tr class="ms_tr">
                        <th>Nome Appartamento</th>
                        <th scope="col">Email</th>
                        <th class="message" scope="col">Messaggio</th>
                        <th scope="col">Data Messaggio</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                   <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->flat->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.dashboard.destroy', ['id' => $message->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
