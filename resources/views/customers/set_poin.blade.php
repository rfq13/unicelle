@extends('layouts.app')

@section('content')
@php
    $member_custom= \App\MemberCustom::where('user_id',$customer)->first();
@endphp
    <div class="row">
        
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Setting Poin dan Diskon Mutlak')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('override_mutlak_poin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$customer}}">
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Poin</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_poin" @if (isset($member_custom)) value="{{ $member_custom->min_order_poin }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Poin Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="poin" @if (isset($member_custom)) value="{{ $member_custom->poin }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">{{__('%')}}</label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Discount</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_discount" @if (isset($member_custom)) value="{{ $member_custom->min_order_discount }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Discount Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="discount" @if (isset($member_custom)) value="{{ $member_custom->discount }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                            <select class="demo-select2" name="type_discount">
                            <option value="amount" @if (isset($member_custom))<?php if($member_custom->type_discount == 'amount') echo "selected";?>@endif >Rp</option>
	                                	<option value="percent" @if (isset($member_custom))<?php if($member_custom->type_discount == 'percent') echo "selected";?>@endif >%</option>
									</select>                           
                             </div>
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
        </div>
         
    </div>

@endsection
