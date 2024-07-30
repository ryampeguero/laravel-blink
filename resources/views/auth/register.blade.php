@extends('layouts.app')

@section('content')
<div class="container mt-4 vh-100  justify-content-center align-items-center d-flex">
    <div class="row justify-content-center ">
        <div class="col-md-12 ">
            <div class="ms_card ms_backC_tertiary p-5 container">
                <h1 class="mb-4">Registrazione</h1>

                <div class="">
                    <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email*</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password*</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma Password*</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>
                        </div>

                        {{-- user poster --}}
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label text-md-right" for="img_path">Inserisci Immagine Profilo</label>

                            <div class="col-md-8">
                                <input class="form-control" type="file" name="img_path" id="img_path">
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="ms_button">
                                    Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
