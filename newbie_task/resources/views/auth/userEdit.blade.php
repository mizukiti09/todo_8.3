@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 max-width">
            <div class="card">
                <div class="card-header"><span class="page-title">{{ __('UserEdit') }}</span> @include('parts.header')
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('userEdit') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $errors->has('*') ? old('name'):($user->name ?? '')}}" required autocomplete="name" autofocus> @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kana" class="col-md-4 col-form-label text-md-end">{{ __('Kana') }}</label>

                            <div class="col-md-6">
                                <input id="kana" type="text" class="form-control @error('kana') is-invalid @enderror" name="kana" value="{{ $errors->has('*') ? old('kana'):($user->kana ?? '')}}" required autocomplete="kana" autofocus> @error('kana')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tel" class="col-md-4 col-form-label text-md-end">{{ __('Tel') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ $errors->has('*') ? old('tel'):($user->tel ?? '')}}" required autocomplete="tel" autofocus> @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $errors->has('*') ? old('email'):($user->email ?? '')}}" required autocomplete="email" autofocus> @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
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