@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Informasi Kupon Voucher')}}</h3>
            </div>

            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                <div class="panel-heading">
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{translate('Nama Merchant')}}</label>
    <div class="col-lg-9">
        <input type="text"  id="coupon_code" name="merchant" class="form-control" required>
    </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">{{translate('Nama Voucher')}}</label>
   <div class="col-lg-9">
      <input type="text" name="judul" class="form-control" required>
   </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">{{translate('Total Point')}}</label>
   <div class="col-lg-9">
      <input type="number"  name="point" class="form-control" required>
   </div>
</div>
<div class="form-group">
<label class="col-lg-3 control-label">{{translate('Thumbnail')}}</label>
<div class="col-lg-9">
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                      <label class="col-lg-3 control-label">{{translate('Syarat dan Ketentuan')}}</label>
                      <div class="col-lg-9">
                      <textarea name="syarat" id="konten-sk" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">{{translate('Cara Pemakaian Voucher')}}</label>
                      <div class="col-lg-9">
                      <textarea name="cara" id="konten-cp" cols="30" rows="10"></textarea>
                      </div>
                    </div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">{{translate('Date')}}</label>
    <div class="col-lg-9">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date">
                <span class="input-group-addon">{{translate('to')}}</span>
                <input type="text" class="form-control" name="end_date">
            </div>
        </div>
    </div>
</div>


                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
                </div>
            </form>

        </div>
    </div>

@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
 $('#demo-dp-range .input-daterange').datepicker({
                startDate: '-0d',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
        	});
    $(document).ready(function(){
        $('.demo-select2').select2();
        $('#konten-sk').summernote({
                    shortcuts: false,
                    indent:true,
                    outdent:true,
                    tabDisable: false,
                    placeholder: 'Start writing...',
                    height: 500,
                    codeviewFilter: true,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['insert', ['link', 'picture']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['view', ['fullscreen', 'codeview']],
                        'undo','redo'
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatCenter', 'floatNone']],
                            ['remove', ['removeMedia']]
                        ]
                    },
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                    callbacks:{
                        onImageUpload: function(files) {
                            uploadImg(files[0])
                        },
                        onMediaDelete : function(target) {
                            deleteFile(target[0].src);
                        }
                    }
                });
                $('#konten-cp').summernote({
                    shortcuts: false,
                    indent:true,
                    outdent:true,
                    tabDisable: false,
                    placeholder: 'Start writing...',
                    height: 500,
                    codeviewFilter: true,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['insert', ['link', 'picture']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['view', ['fullscreen', 'codeview']],
                        'undo','redo'
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatCenter', 'floatNone']],
                            ['remove', ['removeMedia']]
                        ]
                    },
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                    callbacks:{
                        onImageUpload: function(files) {
                            uploadImg(files[0])
                        },
                        onMediaDelete : function(target) {
                            deleteFile(target[0].src);
                        }
                    }
                });
    });

</script>
@endsection