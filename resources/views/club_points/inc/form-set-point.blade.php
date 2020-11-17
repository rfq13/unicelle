<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title text-center">{{__('Tetapkan Poin untuk Produk')}}</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <small>Tetapkan poin spesifik untuk produk tersebut yang berada di antara 'harga minimum' dan 'harga maksimum'. Harga minimum harus kurang dari harga Maks</small>
        </div>
        <form class="form-horizontal" action="{{ route('set_products_point.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="col-lg-6">
                    <label class="control-label">{{__('Set Point untuk beberapa produk')}}</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" min="0" step="0.01" class="form-control" name="point" placeholder="100" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <label class="control-label">{{__('Harga Min')}}</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" min="0" step="0.01" class="form-control" name="min_price" value="{{ \App\Product::min('unit_price') }}" placeholder="50" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <label class="control-label">{{__('Harga Maks')}}</label>
                </div>
                <div class="col-lg-6">
                    <input type="number" min="0" step="0.01" class="form-control" name="max_price" value="{{ \App\Product::max('unit_price') }}" placeholder="110" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12 text-right">
                    <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>