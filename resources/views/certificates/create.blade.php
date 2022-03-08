@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('certificate.index') }}">{{ __('Certificates') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <form action="{{ route('certificate.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="vat">{{ __('VAT') }}</label>
                    <input type="text" class="form-control" id="vat" name="vat" value="{{ old('vat')  }}" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="society">{{ __('Society') }}</label>
                    <textarea rows="6" class="form-control" name="name_society" id="society">{{ old('name_society')  }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <label for="date_certificate">{{ __('Type of certificate') }}</label>
                <div class=" input-group">
                    <select name="type" id="type" class="form-control">
                        <option value="1">Type 1</option>
                        <option value="2">Type 2</option>
                        <option value="3">Type 3</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="date_certificate">{{ __('Date certificate') }}</label>
                <div class=" input-group input-daterange">
                    <input type="text" id="date_certificate" name="date_certificate"
                           class="form-control" placeholder="{{ __('Date certificate') }}" autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <label for="file">{{ __('Certificate') }}</label>
                <div class=" input-group">
                    <input type="file" name="file" class="form-control" accept="application/pdf">
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{ route('certificate.index') }}" class="btn btn-warning mr-2">{{ __('Cancel') }}</a>
                <button class="btn btn-success">{{ __('Create') }}</button>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endsection
