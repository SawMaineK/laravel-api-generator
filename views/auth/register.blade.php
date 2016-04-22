<!DOCTYPE html>
<html>

<head>
    <title>
        Admin - Dashboard
    </title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/se7en-font.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/style.css') }}" media="all" rel="stylesheet" type="text/css" />
    
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/main.js') }}" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
</head>

<body class="login2">
    <!-- Signup Screen -->
    <div class="login-wrapper">
        <a href="#"><img width="100" height="30" src="{{ asset('admin/images/logo-login@2x.png')}}" /></a>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                </div>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                </div>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
               
            </div>
            <div class="form-group">
                <label class="checkbox text-left">
                    <input type="checkbox"><span>I agree to the terms and conditions.</span></label>
            </div>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign up">
            <!-- If you need to social login, uncomment below code -->
            <!-- <div class="social-login clearfix">
                <a class="btn btn-primary pull-left facebook" href="#"><i class="fa fa-facebook"></i>Sign up with facebook</a><a class="btn btn-primary pull-right twitter" href="#"><i class="fa fa-twitter"></i>Sign up with twitter</a>
            </div> -->
            <p>
                Already have an account?
            </p>
            <a class="btn btn-default-outline btn-block" href="{{ url('/login') }}">Login now</a>
        </form>
    </div>
    <!-- End Signup Screen -->
</body>
</html>