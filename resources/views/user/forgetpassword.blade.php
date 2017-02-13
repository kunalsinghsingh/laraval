@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h3>Forget Password</h3>

 @if(Session::has('flash_error'))
 <div class="alert alert-danger">
     {{Session::get('flash_error')}}
     </div>
  @endif
  
<form action="{{route('user.postForgotPassword')}}" method="post">
<div class="form-group">
<label for="email">Email </label>
<input type="text" name="email" id="email" class="form-control">
<div id="email-err" style="color:red;">{{$errors->first('email')}}</div>
</div>
<button type="submit" class="btn btn-primary">Send Mail</button>
{{csrf_field()}}
</form>
</div>
</div>
@endsection