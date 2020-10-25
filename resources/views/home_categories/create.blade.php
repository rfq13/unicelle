<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{translate('Kategori Beranda')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group" id="category">
                <label class="col-lg-2 control-label">{{translate('Kategori')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                        @foreach(\App\Category::all() as $category)
                            @if (\App\HomeCategory::where('category_id', $category->id)->first() == null)
                                <option value="{{$category->id}}">{{__($category->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <a class="btn btn-purple" role="button" href="{{route('home_settings.index')}}">{{translate('Kembali')}}</a>
            <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>
