@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            {{-- <h3 class="panel-title">{{ ucfirst(str_replace('_', ' ',$policy->name))}}</h3> --}}
            <h3 class="panel-title">{{('Petunjuk Dropshipper')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('info.dropshipper.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <input type="hidden" name="name" value="{{ $policy->name }}">
                    <label class="col-sm-2 control-label" for="name">{{translate('Konten')}}</label>
                    <div class="col-sm-10">
                        <textarea class="editor" name="content" required>{{$policy->content}}</textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
            </div>
        </form>

        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
