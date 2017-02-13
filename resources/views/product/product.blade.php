@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h3>Product</h3>

<form action="{{route('product.store')}}" method="post" >
<div class="form-group">
<label for="first_name">Name </label>
<input type="hidden" id="id" name="id" value="<?php if(!empty(@$product->id)) echo @$product->id;  ?>" > 
<input type="text" name="name" id="name" class="form-control" value="{{old('name',@$product->name)}}">
<div id="name-err" style="color:red;">{{$errors->first('name')}}</div>
</div>

<div class="form-group">
<label for="last_name">Details </label>
<textarea  class="form-control" name="details">{{old('details',@$product->details)}}</textarea>
<div id="details-err" style="color:red;">{{$errors->first('details')}}</div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>

{{csrf_field()}}
</form>
</div>
</div>
@endsection