@extends('layouts.app')

@section('content')
@php
   

@endphp
    <?php foreach ($members as $key => $value): ?>
        
    
    <div class="row">
        
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-left">{{__('Setting Member')}} {{ $value->title }}</h3>
            </div>
            <hr>
            <form class="form-horizontal" action="{{ route('set_member_setting') }}" method="POST">
            <div class="panel-body">
                
                    @csrf
                    <input type="hidden" name="id" value="{{ $value->id }}">
                    <div class="col-lg-6">
                    <p style="font-weight:bold">Konfigurasi Poin</p>

                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Tetapkan Poin Pembelian(%)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" max="100" step="0.0001" class="form-control" name="poin_order" value="{{ $value->poin_order }}"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Pembelian(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0"  class="form-control" name="min_order_poin" value="{{ $value->min_order_poin }}"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <p style="font-weight:bold">Konfigurasi Discount</p>

                    <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Tetapkan Discount Pembelian')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.0001" class="form-control" name="discount_order" value="{{ $value->discount_order }}"  required>
                            </div>
                            <div class="col-lg-3">
                            <select class="demo-select2" name="discount_type">
                            <option value="amount" <?php if($value->discount_type == 'amount') echo "selected";?> >Rp</option>
	                                	<option value="percent" <?php if($value->discount_type == 'percent') echo "selected";?> >%</option>
									</select>                           
                             </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Pembelian')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.0001" class="form-control" name="min_order_discount" value="{{ $value->min_order_discount }}"  required>
                            </div>
                            
                        </div>
                    </div>
               
              
            </div>
            <div class="panel-footer">
                <div class="form-group">
                <div class="col-lg-12 text-left">
                    <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                </div>
            </div>
            </div>
            </form>
        </div>
 
    </div>
    <?php endforeach ?>
    
@endsection
