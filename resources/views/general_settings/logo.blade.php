@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Logo Settings')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('generalsettings.logo.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="logo">{{translate('Logo Header')}} <small>(max height 40px)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="logo" name="logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="logo">{{translate('Logo Footer')}}</label>
                        <div class="col-sm-9">
                            <input type="file" id="logo" name="footer_logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="admin_logo">{{translate('Logo Admin')}} <small>(60x60)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="admin_logo" name="admin_logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="favicon">{{translate('Favicon')}} <small>(32x32)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="favicon" name="favicon" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="admin_login_background">{{translate('Gambar Latar Belakang Login Admin')}} <small>(1920x1080)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="admin_login_background" name="admin_login_background" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="admin_login_sidebar">{{translate('Gambar sidebar Login Admin')}} <small>(600x500)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="admin_login_sidebar" name="admin_login_sidebar" class="form-control">
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
