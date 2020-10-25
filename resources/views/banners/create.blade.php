<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{translate('Informasi Banner')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3" for="url">{{translate('URL')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{translate('URL')}}" id="url" name="url" class="form-control" required>
                </div>
            </div>
            <input type="hidden" name="position" value="{{ $position }}">
            {{-- <div class="form-group">
                <label class="col-sm-3" for="url">{{translate('Banner Position')}}</label>
                <div class="col-sm-9">
                    <select class="form-control demo-select2" name="position" required>
                        <option value="1">{{translate('Banner Position 1')}}</option>
                        <option value="2">{{translate('Banner Position 2')}}</option>
                    </select>
                </div>
            </div> --}}
            <div class="form-group">
                <div class="col-sm-3">
                    <label class="control-label">{{translate('Gambar Banner')}}</label>
                    <strong>({{ translate('850px*420px') }})</strong>
                </div>
                <div class="col-sm-9">
                    {{-- <div id="photo">

                    </div> --}}
                    <input type="file" name="photo" id="photo" class="dropify" data-min-width="1109" data-max-width="1111" data-min-hight="439" data-max-width="441"   data-max-file-size="0,3M" data-allowed-file-extensions="jpg png jpeg" required>
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

<script type="text/javascript">

    $(document).ready(function(){

        $('.demo-select2').select2();

        // $("#photo").spartanMultiImagePicker({
        //     fieldName:        'photo',
        //     maxCount:         1,
        //     rowHeight:        '200px',
        //     groupClassName:   'col-md-4 col-sm-9 col-xs-6',
        //     maxFileSize:      '',
        //     dropFileLabel : "Drop Here",
        //     onExtensionErr : function(index, file){
        //         console.log(index, file,  'extension err');
        //         alert('Please only input png or jpg type file')
        //     },
        //     onSizeErr : function(index, file){
        //         console.log(index, file,  'file size too big');
        //         alert('File size too big');
        //     }
        // });
        $('#photo').dropify({
                    messages: {
                        'default': 'Drag and drop gambar',
                        'replace': 'Drag and drop atau click untuk mengubah gambar',
                        'remove':  'Hapus',
                        'error':   'Ooops, ada kesalahan.'
                    },

                    error: {
                        'imageFormat': 'Hanya mendukung format gambar "jpg" "png" "jpeg".'
                    }
                });
    });

</script>
