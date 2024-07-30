@extends('layouts.app')
@section('content')
    <div class="p-5 mb-4 vh-100 d-flex justify-content-center align-items-center">
        <div class="ms_card p-5 ms_backC_tertiary text-center flex-column d-flex justify-content-center align-items-center">
            <div class="">

            </div>
            <h1 class="display-5 fw-bold">
                <span> Benvenuto nella zona </span><br>
                amministratori di Blink
            </h1>
            <a class="text-white ms_button_login mt-3" href="{{ route('login') }}">Accedi</a>
            <a class="text-white ms_button_login mt-2 " href="{{ route('register') }}">Registrati</a>
        </div>
    </div>

    <div class="content">
        <div class="container">
        </div>
    </div>
@endsection
