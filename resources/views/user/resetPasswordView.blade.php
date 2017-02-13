
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Materia - Admin Template">
        <meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
        <meta name="author" content="solutionportal">
        <!-- <base href="/"> -->
       
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('public/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/css/bootstrap.min.css') }}" rel="stylesheet"


    </head>
    <body >
       <div class="row">
<div class="col-md-4 col-md-offset-4">
                
                            <h5 class="text-normal h5 text-center">Reset Your Password</h5>
                        
                        <div id="flash_error" class='err_display'>{{ Session::get('flash_error') }}</div>
                       
                            <form  method="POST" action="{{URL::route('changePass')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">

                                    
                                    <label>New Password</label>
                                    <input type="password"  class="md-input" name="password" id="password" class="form-control">
                                    @if ($errors->has('password')) <p class="help-block err_display">{{ $errors->first('password') }}</p> @endif
                                </div>

                                <div class="form-group">
                                    
                                    <label>Retype Password</label>
                                    <input value="{{$code}}" name="code" type="hidden">
                                    <input type="password"  class="md-input" name="retype_password" id="retype_password" class="form-control">
                                    @if ($errors->has('retype_password')) <p class="help-block err_display">{{ $errors->first('retype_password')}}</p> @endif
                                </div>

                               
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                              
                            </form>
                       
</div></div>
                   
                
        
    </body>
    
</html>