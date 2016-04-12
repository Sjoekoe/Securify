@extends('layouts.marketing')

@section('content')
    <body class="login-page">
    <!-- Start #login -->

    <login></login>
    <template id="login">
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
                                    <input type="text" name="email" id="email" class="form-control left-icon" placeholder="Your email ..." v-model="email">
                                    <i class="ec-user s16 left-input-icon"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="password" name="password" id="password" class="form-control left-icon" placeholder="Your password" v-model="password">
                                    <i class="ec-locked s16 left-input-icon"></i>
                                    <span class="help-block"><a href="#"><small>Forgot password ?</small></a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                    <!-- col-lg-12 start here -->
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" id="remember" value="option" v-model="remember">Remember me ?
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
                        <form class="form-horizontal mt10">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control left-icon required" placeholder="Your full name" v-model="name">
                                    <i class="ec-user s16 left-input-icon"></i>
                                    <label for="" class="help-block text-danger" v-if="errors.name">@{{ errors.name }}</label>
                                </div>
                                <div class="col-lg-12 mt15">
                                    <!-- col-lg-12 start here -->
                                    <input id="email1" name="email" type="email" class="form-control left-icon" placeholder="Type your email" v-model="email">
                                    <i class="ec-mail s16 left-input-icon"></i>
                                    <label for="" class="help-block text-danger" v-if="errors.email">@{{ errors.email }}</label>
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <input type="password" class="form-control left-icon" id="password1" name="password" placeholder="Enter your password" v-model="password">
                                    <i class="ec-locked s16 left-input-icon"></i>
                                    <label for="" class="help-block text-danger" v-if="errors.password">@{{ errors.password }}</label>
                                </div>
                                <!-- col-lg-12 end here -->
                                <div class="col-lg-12 mt15">
                                    <!-- col-lg-12 start here -->
                                    <input type="password" class="form-control left-icon" id="confirm_password" name="confirm_passowrd" placeholder="Repeat password" v-model="password_confirmation">
                                    <i class="ec-locked s16 left-input-icon"></i>
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <template v-if="submitting">
                                        <button class="btn btn-success btn-block" disabled><i class="fa fa-spinner fa-spin fa-2x"></i> @{{ status }}</button>
                                    </template>
                                    <template v-else>
                                        <button class="btn btn-success btn-block" @click="register">Register</button>
                                    </template>
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</body>

@stop
