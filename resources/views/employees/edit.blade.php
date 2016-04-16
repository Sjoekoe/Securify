@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Edit Employee'])
    <div class="row">
        <div class="col-md-9">
            <editemployee></editemployee>

            <template id="edit-employee">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            Employee details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger fade in" v-if="error">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetErrorState">×</button>
                            <i class="fa-remove alert-icon s24"></i>
                            @{{ errorMessage }}
                        </div>
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Name</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Employees full name" autofocus="autofocus" name="name", v-model="name">
                                    <label class="help-block text-danger" v-if="errors.name">@{{ errors.name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="email">Email</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="email" class="form-control" placeholder="Employees email" autofocus="autofocus" name="email", v-model="email">
                                    <label class="help-block text-danger" v-if="errors.email">@{{ errors.email }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="email">Employee number</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Employee number" autofocus="autofocus" name="number", v-model="number">
                                    <label class="help-block text-danger" v-if="errors.number">@{{ errors.number }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="email">Telephone</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Employee Telephone" autofocus="autofocus" name="telephone", v-model="telephone">
                                    <label class="help-block text-danger" v-if="errors.telephone">@{{ errors.telephone }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2">
                                    <template v-if="submitting">
                                        <button class="btn btn-primary ml15" type="submit" disabled>
                                            <i class="fa fa-spinner fa-spin"></i> @{{ status }}
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button class="btn btn-primary ml15" type="submit" @click="editEmployee(id)">Save Employee</button>
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
