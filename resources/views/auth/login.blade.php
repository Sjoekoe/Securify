@extends('layouts.marketing')

@section('content')
    <body class="login-page">
    <!-- Start #login -->
    <div id="login" class="animated bounceIn">
        <div class="login-wrapper">
            <ul id="myTab" class="nav nav-tabs nav-justified bn">
                <li>
                    <a href="#log-in" data-toggle="tab">Login</a>
                </li>
                <li class="">
                    <a href="#register" data-toggle="tab">Register</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content bn">
                <div class="tab-pane fade active in" id="log-in">
                    <form class="form-horizontal mt10" action="index.html" id="login-form" role="form">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" name="email" id="email" class="form-control left-icon" value="admin@sprflat.com" placeholder="Your email ...">
                                <i class="ec-user s16 left-input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" name="password" id="password" class="form-control left-icon" value="somepass" placeholder="Your password">
                                <i class="ec-locked s16 left-input-icon"></i>
                                <span class="help-block"><a href="#"><small>Forgout password ?</small></a></span>
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
                    </form>
                </div>
                <div class="tab-pane fade" id="register">
                    <form class="form-horizontal mt20" action="#" id="register-form" role="form">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <!-- col-lg-12 start here -->
                                <input id="email1" name="email" type="email" class="form-control left-icon" placeholder="Type your email">
                                <i class="ec-mail s16 left-input-icon"></i>
                            </div>
                            <!-- col-lg-12 end here -->
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <!-- col-lg-12 start here -->
                                <input type="password" class="form-control left-icon" id="password1" name="password" placeholder="Enter your password">
                                <i class="ec-locked s16 left-input-icon"></i>
                            </div>
                            <!-- col-lg-12 end here -->
                            <div class="col-lg-12 mt15">
                                <!-- col-lg-12 start here -->
                                <input type="password" class="form-control left-icon" id="confirm_password" name="confirm_passowrd" placeholder="Repeat password">
                                <i class="ec-locked s16 left-input-icon"></i>
                            </div>
                            <!-- col-lg-12 end here -->
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <!-- col-lg-12 start here -->
                                <button class="btn btn-success btn-block">Register</button>
                            </div>
                            <!-- col-lg-12 end here -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End #.login-wrapper -->
    </div>
@stop
