@extends('layouts.app')
@section('content')
    <div class="bg-dark p-5 mb-4">
        <div class="container text-center py-5 flex-column d-flex justify-content-center align-items-center">
            <div class="">

            </div>
            <h1 class="display-5 fw-bold text-white">
                <span> Benvenuto nella zona </span>amministratori di Blink
            </h1>
            <a class="text-white ms_button_login mt-5" href="{{ route('login') }}">Accedi</a>
            <a class="text-white ms_button_login mt-2 " href="{{ route('register') }}">Registrati</a>
        </div>
    </div>

    <div class="content">
        <div class="container">
        </div>
    </div>
@endsection
