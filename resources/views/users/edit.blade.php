@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
        </ol>
    </nav>
@endsection

@section('content')

    <form action="{{ route('profile.update', $user) }}" class="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
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
            <div class="col-md-4">
                <label for="name">{{ __('Name') }}</label>
                <div class="form-group ">
                    <input type="text" id="name" name="name" class="form-control" required
                           value="{{ old('name') ?? $user->name }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group m-r-10">
                    <label for="email">{{ __('Mail') }}</label>
                    <input type="email" id="email" name="email" class="form-control "
                           value="{{ old('email') ?? $user->email }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="new_password">{{ __('New password') }}</label>
                    <input type="password" id="new_password" name="new_password" class="form-control">
                </div>
            </div>

        </div>
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('dashboard') }}"
               class="btn btn-warning mr-2">{{ __('Back') }}</a>
            <button type="submit" class="btn btn-success ">{{ __('Save change') }}</button>
        </div>
    </form>
@endsection

@push('after-scripts')
    <script>
        $('input[name="avatar"]').on('change', function (event) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#cover').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush
