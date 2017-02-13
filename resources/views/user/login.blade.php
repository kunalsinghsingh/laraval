@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h3>Sign In</h3>
@if(Session::has('flash_error'))
 <div class="alert alert-danger">
     {{Session::get('flash_error')}}
     </div>
  @endif
<form action="{{route('user.signin')}}" method="post">
<div class="form-group">
<label for="email">Email </label>
<input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
<div id="email-err" style="color:red;">{{$errors->first('email')}}</div>
</div>


<div class="form-group">
<label for="password">Password </label>
<input type="password" name="password" id="password" class="form-control">
<div id="password-err" style="color:red;">{{$errors->first('password')}}</div>
</div>



<button type="submit" class="btn btn-primary">Sign in</button>
<a href="{{route('user.forget')}}">Forget Password</a>

{{csrf_field()}}
</form>
</div>
</div>
@endsection