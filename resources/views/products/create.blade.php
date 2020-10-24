@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Add New Product') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			<input type="hidden" name="added_by" value="admin">
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Informasi Produk')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Nama Produk')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" required>
						</div>
					</div>
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Kategori')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
								@foreach($categories as $category)
									<option value="{{$category->id}}">{{__($category->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					{{-- 
						<div class="form-group" id="subcategory">
							<label class="col-lg-2 control-label">{{translate('Subcategory')}}</label>
							<div class="col-lg-7">
								<select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>

								</select>
							</div>
						</div>
						<div class="form-group" id="subsubcategory">
							<label class="col-lg-2 control-label">{{translate('Sub Subcategory')}}</label>
							<div class="col-lg-7">
								<select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

								</select>
							</div>
						</div>
						<div class="form-group" id="brand">
							<label class="col-lg-2 control-label">{{translate('Brand')}}</label>
							<div class="col-lg-7">
								<select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
									<option value="">{{ ('Select Brand') }}</option>
									@foreach (\App\Brand::all() as $brand)
										<option value="{{ $brand->id }}">{{ $brand->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					--}}
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Satuan')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" required>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Jumlah Minimal')}}</label>
						<div class="col-lg-7">
							<input type="number" class="form-control" name="min_qty" value="1" min="1" required>
						</div>
					</div>
					{{--<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Tags')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="tags[]" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">
						</div>
					</div> --}}
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Indikasi')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="indication[]" placeholder="{{ translate('masukkan indikasi obat') }}" data-role="tagsinput">
						</div>
					</div>
					@php
					    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
					@endphp
					@if ($pos_addon != null && $pos_addon->activated == 1)
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Barcode')}}</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="barcode" placeholder="{{ translate('Barcode') }}">
							</div>
						</div>
					@endif

					@php
					    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
					@endphp
					@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
							<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Refundable')}}</label>
							<div class="col-lg-7">
								<label class="switch" style="margin-top:5px;">
									<input type="checkbox" name="refundable" checked>
		                            <span class="slider round"></span></label>
								</label>
							</div>
							</div>
					@endif
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Gambar Produk')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Gambar Produk')}} <br> <small>(160x200)</small></label>
						<div class="col-lg-7">
							<div id="photos">

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Thumbnail')}} <small>(160x200)</small></label>
						<div class="col-lg-7">
							<div id="thumbnail_img">

							</div>
						</div>
					</div>
				</div>
			</div>
			{{--
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Videos')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Provider')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
								<option value="youtube">{{translate('Youtube')}}</option>
								<option value="dailymotion">{{translate('Dailymotion')}}</option>
								<option value="vimeo">{{translate('Vimeo')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Link')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video Link') }}">
						</div>
					</div>
				</div>
			</div>
			--}}
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Varian Produk')}}</h3>
				</div>
				
				
				<div class="panel-body">
					{{--
						<div class="form-group">
							<div class="col-lg-2">
								<input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
							</div>
							<div class="col-lg-7">
								<select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
									@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
										<option value="{{ $color->code }}">{{ $color->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-lg-2">
								<label class="switch" style="margin-top:5px;">
									<input value="1" type="checkbox" name="colors_active">
									<span class="slider round"></span>
								</label>
							</div>
						</div>
					--}}

					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="{{translate('Atribut')}}" disabled>
						</div>
	                    <div class="col-lg-7">
	                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="{{ translate('Pilih Atribut') }}">
								@foreach (\App\Attribute::all() as $key => $attribute)
									<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
								@endforeach
	                        </select>
	                    </div>
	                </div>

					<div>
						<p>{{ translate('silahkan pilih atribut varian produk') }}</p>
						<br>
					</div>

					<div class="customer_choice_options" id="customer_choice_options">

					</div>

					{{-- <div class="customer_choice_options" id="customer_choice_options">

					</div>
					<div class="form-group">
						<div class="col-lg-2">
							<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ translate('Add more customer choice option') }}</button>
						</div>
					</div> --}}
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Harga Produk dan Jumlah Stoknya')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Harga Satuan')}}</label>
						{{-- <div class="col-lg-3" style="display: none">
							<input type="number" min="0" value="0" step="0.01" id="unit_price" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control">
						</div> --}}
						<div class="col-lg-3">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Regular Physician Price') }}" name="regular_physician_price" class="form-control product-price" id="rpp" required>
							<span style="font-size: 10px;font-style:italic">*HET Regular Physician</span>
						</div>
						<div class="col-lg-3">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Partner Physician Price') }}" name="partner_physician_price" class="form-control product-price" id="ppp" required>
							<span style="font-size: 10px;font-style:italic">*HET Partner Physician</span>
						</div>
						<div class="col-lg-3">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Pasien Regular Price') }}" name="pasien_regular_price" class="form-control product-price" id="prp" required>
							<span style="font-size: 10px;font-style:italic">*HET Pasien Regular</span>
						</div>
					</div>
					{{--
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Purchase price')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Purchase price') }}" name="purchase_price" class="form-control" required>
						</div>
					</div>
					--}}
					
					<div class="form-group">

						{{--
						<label class="col-lg-2 control-label">{{translate('Tax')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax" class="form-control" required>
						</div>


						<div class="col-lg-1">
							<select class="demo-select2" name="tax_type">
								<option value="amount">{{translate('Flat')}}</option>
								<option value="percent">{{translate('Percent')}}</option>
							</select>
						</div>
						--}}

					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Discount')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control" required>
						</div>
						<div class="col-lg-1">
							<select class="demo-select2" name="discount_type">
								<option value="amount">{{translate('Flat')}}</option>
								<option value="percent">{{translate('Percent')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group" id="quantity">
						<label class="col-lg-2 control-label">{{translate('Quantity')}}</label>
						<div class="col-lg-7">
							<input type="number" min="0" value="0" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="sku_combination" id="sku_combination">

					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Deskripsi Produk')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Produk')}}</label>
						<div class="col-lg-9">
							<textarea class="editor" name="description"></textarea>
						</div>
					</div>
				</div>
			</div>

			{{--
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('SEO Meta Tags')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Meta Title')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_title" placeholder="{{ translate('Meta Title') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Description')}}</label>
						<div class="col-lg-7">
							<textarea name="meta_description" rows="8" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{ translate('Meta Image') }}</label>
						<div class="col-lg-7">
							<div id="meta_photo">

							</div>
						</div>
					</div>
				</div>
			</div>

			--}}
			
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info" id="btnSubmit">{{ translate('Tambah Produk Baru') }}</button>
				{{-- <a href="#" id="btnTambah" class="btn btn-info">{{ translate('Tambah') }}</a> --}}
			</div>
		</form>
	</div>
</div>


@endsection

@section('script')
<script type="text/javascript">

	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{{ translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if (data.length > 1) {
				   $('#quantity').hide();
			   }
			   else {
					$('#quantity').show();
			   }
		   }
	   });
	}

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		});
	}

	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#choice_attributes').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#choice_attributes').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
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
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
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
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
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

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    // get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

	$('#choice_attributes').on('change', function() {
		$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(){
			//console.log($(this).val());
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
		update_sku();
	});


</script>

@endsection
