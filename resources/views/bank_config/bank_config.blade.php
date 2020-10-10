@extends('layouts.app')

@section('content')
@php
   
    $bank_setting = \App\BusinessSetting::where('type', 'bank_setting')->first();
    if($bank_setting == null)
    {
        $bank_setting = new  \App\BusinessSetting;
        $bank_setting->type = "bank_setting";
        $bank_setting->value=  json_encode([
            'LOGO' => null,
            'BANK_NAME' => null,
            'BANK_NO_REK' => null,
            'BANK_ATAS_NAMA' =>null
        ]);
        $bank_setting->save();
    }
    $config =  json_decode( $bank_setting->value);
@endphp
    <div class="row">
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Bank Setting')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('bank_setup_store') }}" enctype="multipart/form-data"  method="POST">
                        @csrf
                        <input type="hidden" name="type" value="club_point_convert_rate">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">Logo Bank</label>
                            </div>
                            <div class="col-lg-8">
                                <div id="bank_logo">
                                    @if ($config->LOGO != null)
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="img-upload-preview">
                                                <img loading="lazy"  src="{{ my_asset($config->LOGO) }}" alt="" class="img-responsive">
                                                <input type="hidden" name="previous_logo" value="{{ $config->LOGO }}">
                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">Nama Bank</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="BANK_NAME" value="{{ $config->BANK_NAME }}" placeholder="nama bank" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">No. Rekening</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control"  name="BANK_NO_REK" value="{{ $config->BANK_NO_REK }}" placeholder="nomer rekening bank" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">Atas Nama Rekening</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="BANK_ATAS_NAMA" value="{{ $config->BANK_ATAS_NAMA }}" placeholder="atas nama rekening" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){

    $("#bank_logo").spartanMultiImagePicker({
        fieldName:        'logo',
        maxCount:         1,
        rowHeight:        '200px',
        groupClassName:   'col-md-4 col-sm-4 col-xs-6',
        maxFileSize:      '',
        dropFileLabel : "Drop Here",
        onExtensionErr : function(index, file){
            console.log(index, file,  'extension err');
            alert('Please only input png or jpg type file')
        },
        onSizeErr : function(index, file){
            console.log(index, file,  'file size too big');
            alert('File size too big');
        }
    });

});
</script>

@endsection



