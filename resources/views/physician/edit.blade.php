@extends('layouts.app')

@section('content')

<div class="col">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Informasi Tenaga Kesehatan')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('physician.update', $userDetail->id) }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Nama')}}</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="{{translate('Nama')}}" id="name" name="name" class="form-control" required value="{{$userDetail->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Email')}}</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="{{translate('Email')}}" id="email" name="email" class="form-control" required value="{{$userDetail->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('No Telepon')}}</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="{{translate('No telepon')}}" id="phone" name="phone" class="form-control" required value="{{$userDetail->phone}}">
                    </div>
                </div>
                <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputPassword3">Jenis
                                            Kelamin</label>
                                            <div class="col-sm-8">

                                        <div class="form-check form-check-inline col-sm-6 pl-3">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" {{$userDetail->gender == 1 ? "checked":''}}  required>
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline col-sm-4">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" {{$userDetail->gender == 2 ? "checked":''}} required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                        </div>
                                    </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                    <input type="text" value="{{$userDetail->birth}}" class="form-control datepicker" name="birth" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Poin')}}</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="{{translate('Poin')}}" id="poin" name="poin" class="form-control" required value="{{$userDetail->poin}}">
                    </div>
                </div>    
            </div>
            <div class="panel-footer text-right">
            <a style="padding: 10px 20px;border-radius: 5px;background-color: lavender;" href="{{ route('physician.verify') }}">Batal</a>
            <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
@section('script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( "#datepicker" ).datepicker({
        changeMonth: true,
      changeYear: true,
      yearRange: "-100:+0",
dateFormat: "yy-mm-dd",
});
</script>
@endsection