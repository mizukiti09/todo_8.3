@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 max-width">
            <div class="card">
                <div class="card-header"><span class="page-title">{{ __('GroupOwner') }}</span> @include('parts.header')
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('imgUpdate') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="img1" class="col-md-4 col-form-label text-md-end">連絡事項img1</label>

                            <div class="col-md-6">
                                <input id="img1" type="file" class="form-control @error('img1') is-invalid @enderror" name="img1" value="{{ old('img1') }}" autocomplete="img1" autofocus> @error('img1')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img2" class="col-md-4 col-form-label text-md-end">連絡事項img2</label>

                            <div class="col-md-6">
                                <input id="img2" type="file" class="form-control @error('img2') is-invalid @enderror" name="img2" value="{{ old('img2') }}" autocomplete="img2" autofocus> @error('img2')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img1" class="col-md-4 col-form-label text-md-end">連絡事項img3</label>

                            <div class="col-md-6">
                                <input id="img3" type="file" class="form-control @error('img3') is-invalid @enderror" name="img3" value="{{ old('img3') }}" autocomplete="img3" autofocus> @error('img3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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