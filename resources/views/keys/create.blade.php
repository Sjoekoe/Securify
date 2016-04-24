@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Create Visitor'])

    <div class="row">
        <createkey></createkey>

        <template id="create-key">
            <div class="col-md-12">
                <div class="alert alert-danger fade in" v-if="error">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetErrorState">×</button>
                    <i class="fa-remove alert-icon s24"></i>
                    @{{ errorMessage }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            Key Details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Key name</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Key short name" autofocus="autofocus" name="name", v-model="name">
                                    <label class="help-block text-danger" v-if="errors.name">@{{ errors.name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="number">Key number</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Key number" autofocus="autofocus" name="number", v-model="number">
                                    <label class="help-block text-danger" v-if="errors.number">@{{ errors.number }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="key_code">Key code</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Key code" autofocus="autofocus" name="key_code", v-model="key_code">
                                    <label class="help-block text-danger" v-if="errors.key_code">@{{ errors.key_code }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="description">Key description</label>
                                <div class="col-lg-10 col-md-10">
                                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="description" v-model="description"></textarea>
                                    <label class="help-block text-danger" v-if="errors.description">@{{ errors.description }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary ml15" v-if="submitting" disabled>
                                    <i class="fa fa-spinner fa-spin"></i> @{{ status }}
                                </button>
                                <button class="btn btn-primary ml15" @click="submit" v-else>Create Key</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
@stop
