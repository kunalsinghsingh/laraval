@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h3>Sign Up</h3>

<form action="{{route('user.signup')}}" method="post">


<div class="form-group">
<label for="last_name">User Name </label>
<input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
<div id="username-err" style="color:red;">{{$errors->first('username')}}</div>
</div>

<div class="form-group">
<label for="email">Email </label>
<input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
<div id="email-err" style="color:red;">{{$errors->first('email')}}</div>
</div>



<div class="form-group">
<label for="password">Password </label>
<input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
<div id="password-err" style="color:red;">{{$errors->first('password')}}</div>
</div>

<div class="form-group">
<label for="re-password">Confirm Password </label>
<input type="password" name="cpassword" id="cpassword" class="form-control">
<div id="cpassword-err" style="color:red;">{{$errors->first('cpassword')}}</div>
</div>
<button type="submit" class="btn btn-primary">Sign up</button>

{{csrf_field()}}
</form>
</div>
</div>
@endsection