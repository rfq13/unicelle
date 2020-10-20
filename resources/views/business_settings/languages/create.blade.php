@extends('layouts.app')

@section('content')


<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title text-center">{{ translate('Info Bahasa') }}</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('languages.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="col-lg-3">
                        <label class="control-label">{{ translate('Nama') }}</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Nama') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <label class="control-label">{{ translate('Kode') }}</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="country-flag-select" name="code">
                            @foreach(\File::files(base_path('public/frontend/images/icons/flags')) as $path)
                                <option value="{{ pathinfo($path)['filename'] }}" data-flag="{{ my_asset('frontend/images/icons/flags/'.pathinfo($path)['filename'].'.png') }}"> {{ strtoupper(pathinfo($path)['filename']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-purple" type="submit">{{ translate('Simpan') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
