@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Certificates') }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row mb-6 justify-content-end">
        <a href="{{ route('certificate.create') }}" class="btn btn-success mb-1">{{ __('Create') }}</a>
    </div>
    <div class="row table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('VAT') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
            <tr>
                {{-- Here will be search bar on list--}}
            </tr>
            </thead>
            <tbody>
            @foreach($certificates as $certificate)
                <tr>
                    <th scope="row">{{ $certificates->perPage()*($certificates->currentPage() - 1) + $loop->iteration }}</th>
                    <td>{{ $certificate->vat }}</td>
                    <td>{{ $certificate->date_certificate }}</td>
                    <td>
                        <a href="{{ route('certificate.edit', $certificate->id) }}"
                           class="btn btn-primary  btn-sm ">
                            <i class="fa fa-edit"></i></a>

                        <form action="{{ route('certificate.destroy', $certificate->id) }}" method="POST"
                              class="d-inline"
                              onsubmit='return confirm("@lang('messages.Confirm action')")'>
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="ml-3">
            {{ $certificates->links() }}
        </div>
    </div>
@endsection
