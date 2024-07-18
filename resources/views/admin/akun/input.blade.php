@extends('layouts.layout')
@section('content')
<form action="{{route('akun.store')}}" method="POST">@csrf
 <fieldset><legend>Input Data Akun</legend>
 <div class="form-group row">
 <div class="col-md-5">
 <label for="usname">Kode Akun</label>
 <input id="addnoakun" type="text" name="addnoakun" class="formcontrol"required>
 </div>
 <div class="col-md-5">
 <label for="nama">Nama Akun</label>
 <input id="addnmakun" type="text" name=addnmakun" class="formcontrol"required>
 </div>
 </div>
 <div class="col-md-10">
 <input type="submit" class="btn btn-success btn-send" value="Simpan">
 <input type="Button" class="btn btn-primary btnsend" value="Kembali" onclick="history.go(-1)">
 </div>
 <hr>
 </fieldset>
</form>
@endsection