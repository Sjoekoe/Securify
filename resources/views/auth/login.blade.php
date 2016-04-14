@extends('layouts.marketing')

@section('content')
    <body class="login-page">
    <!-- Start #login -->

    <div id="login" class="animated bounceIn">
        <div class="login-wrapper">
            <div id="myTabContent" class="tab-content bn">
                <div class="tab-pane fade active in" id="log-in">
                    {{ Form::open(['route' => 'login.post', 'class' => 'form-horizontal mt10', 'id' => 'login-form']) }}
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" name="email" id="email" class="form-control left-icon" placeholder="Your email ...">
                                <i class="ec-user s16 left-input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" name="password" id="password" class="form-control left-icon" placeholder="Your password">
                                <i class="ec-locked s16 left-input-icon"></i>
                                <span class="help-block"><a href="#"><small>Forgot password ?</small></a></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <!-- col-lg-12 start here -->
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" id="remember" value="option">Remember me ?
                                </label>
                            </div>
                            <!-- col-lg-12 end here -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <!-- col-lg-12 start here -->
                                <button class="btn btn-success pull-right" type="submit">Login</button>
                            </div>
                            <!-- col-lg-12 end here -->
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</body>

@stop
