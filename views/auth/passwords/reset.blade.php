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
    <!-- Reset Screen -->
    <div class="login-wrapper">
        <a href="#"><img width="100" height="30" src="{{ asset('admin/images/logo-login@2x.png')}}" /></a>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-refresh"></i>Reset Password
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- End Reset Screen -->
</body>
</html>