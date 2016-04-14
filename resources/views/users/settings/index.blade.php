@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                Settings
            </h1>
            <usersettings></usersettings>

            <template id="user-settings">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            User details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success fade in" v-if="success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetSuccessState">×</button>
                            <i class="fa-ok alert-icon s24"></i>
                            Your profile has been updated
                        </div>
                        <div class="alert alert-danger fade in" v-if="error">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetErrorState">×</button>
                            <i class="fa-remove alert-icon s24"></i>
                            @{{ errorMessage }}
                        </div>
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Name</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Your full name" autofocus="autofocus" name="name", v-model="name">
                                    <label class="help-block text-danger" v-if="errors.name">@{{ errors.name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="email">Email</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="email" class="form-control" placeholder="Your email" autofocus="autofocus" name="email", v-model="email">
                                    <label class="help-block text-danger" v-if="errors.email">@{{ errors.email }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2">
                                    <template v-if="submitting">
                                        <button class="btn btn-primary ml15" type="submit" disabled>
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button class="btn btn-primary ml15" type="submit" @click="update">Save Settings</button>
                                    </template>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
@stop
