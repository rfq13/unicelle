@if(count($combinations[0]) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-center">
					<label for="" class="control-label">{{translate('Variant')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{translate('Variant Price')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{translate('SKU')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{translate('Quantity')}}</label>
				</td>
			</tr>
		</thead>
		<tbody>
@foreach ($combinations as $key => $combination)
	@php
		$sku = '';
		foreach (explode(' ', $product_name) as $key => $value) {
			$sku .= substr($value, 0, 1);
		}

		$str = '';
		foreach ($combination as $key => $item){
			if($key > 0 ){
				$str .= '-'.str_replace(' ', '', $item);
				$sku .='-'.str_replace(' ', '', $item);
			}
			else{
				if($colors_active == 1){
					$color_name = \App\Color::where('code', $item)->first()->name;
					$str .= $color_name;
					$sku .='-'.$color_name;
				}
				else{
					$str .= str_replace(' ', '', $item);
					$sku .='-'.str_replace(' ', '', $item);
				}
			}
		}
	@endphp
	@if(strlen($str) > 0)
		<tr>
			<td>
				<label for="" class="control-label">{{ $str}}</label>
			</td>
			<td>
				@php
					$sku_price = \App\ProductStock::where(['product_id'=>$product->id,'variant'=>$str])->first();
					$rpp = $sku_price != null ? $sku_price->regular_physician_price : 0;
					$ppp = $sku_price != null ? $sku_price->partner_physician_price : 0;
					$prp = $sku_price != null ? $sku_price->pasien_regular_price : 0;
                    // if ($product->unit_price == $unit_price) {
					// 	if(($stock = $product->stocks->where('variant', $str)->first()) != null){
	                //         echo $stock->price;
	                //     }
	                //     else{
	                //         echo $unit_price;
	                //     }
                    // }
					// else{
					// 	echo $unit_price;
					// }
					// dd($price);
                @endphp
				<cite style="font-size: 82%">HET Regular Physician</cite><input type="number" name="price_{{ $str }}_rpp" value="{{ $rpp }}" min="0"  class="form-control" required>
				<cite style="font-size: 82%">HET Partner Physician</cite><input type="number" name="price_{{ $str }}_ppp" value="{{ $ppp }}" min="0"  class="form-control" required>
				<cite style="font-size: 82%">HET Pasien Regular</cite><input type="number" name="price_{{ $str }}_prp" value="{{ $prp }}" min="0"  class="form-control" required>
			</td>
			<td>
				<input type="text" name="sku_{{ $str }}" value="{{ $sku }}" class="form-control" required>
			</td>
			<td>
				<input type="number" name="qty_{{ $str }}" value="@php
                    if(($stock = $product->stocks->where('variant', $str)->first()) != null){
                        echo $stock->qty;
                    }
                    else{
                        echo '10';
                    }
                @endphp" min="0" step="1" class="form-control" required>
			</td>
		</tr>
	@endif
@endforeach

	</tbody>
</table>
@endif
