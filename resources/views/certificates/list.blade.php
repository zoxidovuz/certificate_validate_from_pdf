@extends('layouts.front.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ __('Certificates') }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('certificates.list') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="vat" value="{{ request('vat') }}" class="form-control"
                                   placeholder="{{ __('VAT') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name_society" value="{{ request('name_society') }}" class="form-control"
                                   placeholder="{{ __('Society') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class=" input-group input-daterange">
                                <input type="text" id="date_certificate" name="date_certificate" value="{{ request('date_certificate') }}"
                                       class="form-control" placeholder="{{ __('Date certificate') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($certifications as $certification)
                <div class="card  mb-3">
                    <div class="card-header">{{ $certification->vat }}</div>
                    <div class="card-body">
                        <h5 class="card-title">Date: {{ $certification->date_certificate }}</h5>
                        <p class="card-text">{{ $certification->name_society }}</p>
                        <a href="{{ route('certificates.download', $certification) }}" class="btn btn-success float-right">Download certificate</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ml-3">
            {{ $certifications->links() }}
        </div>
    </div>
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
