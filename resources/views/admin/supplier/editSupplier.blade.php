@extends('layouts.layout')
@section('content')
<form action="{{route('supplier.update', [$supplier->kd_supp])}}" method="POST">
 @csrf
 <input type="hidden" name="_method" value="PUT">
 <fieldset>
 <legend>Ubah Data Supplier</legend>
 <div class="form-group row">
 <div class="col-md-5">
 <label for="addkdsupp">Kode Supplier</label>
 <input class="formcontrol" type="text" name="addkdsupp" value="{{$supplier->kd_supp}}" readonly>
 </div>
 <div class="col-md-5">
 <label for="addnmsupp">Nama Supplier</label>
 <input id="addnmsupp" type="text" name="addnmsupp" class="formcontrol" value="{{$supplier->nm_supp}}">
 </div>
 </div>
 <div class="form-group row">
 <div class="col-md-5">
 <label for="Alamat">Alamat</label>
 <input id="addalamat" type="text" name="addalamat" class="formcontrol" value="{{$supplier->alamat}}">
 </div>
 <div class="col-md-5">
 <label for="Telepon">No. Telepon</label>
 <input id="addtelepon" type="text" name="addtelepon" class="formcontrol" value="{{$supplier->telepon}}">
 </div>
 </div>
 </fieldset>
 <div class="col-md-10">
 <input type="submit" class="btn btn-success btn-send" value="Update">
 <a href="{{ route('supplier.index') }}"><input type="Button" class="btn btn
-primary btn-send" value="Kembali"></a>
 </div>
 <hr>
</form>
@endsection