@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Edit Visitor'])
    <div class="row">
        <updatevisit></updatevisit>

        <template id="update-visit">
            <div class="col-md-12">
                <div class="alert alert-danger fade in" v-if="error">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetErrorState">×</button>
                    <i class="fa-remove alert-icon s24"></i>
                    @{{ errorMessage }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            Visitor details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Select Visitor</label>
                                <div class="col-lg-10 col-md-10">
                                    <select name="visitor_id" id="visitor_id" class="form-control" v-model="visitor" @change="updateVisitor">
                                    <option value="0" selected>Create new Visitor</option>
                                    <option v-for="visitor in visitors" value="@{{ visitor.id }}">@{{ visitor.name }}</option>
                                    </select>
                                    <label class="help-block text-danger" v-if="errors.name">@{{ errors.visitor }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Name</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" placeholder="Visitors' full name" autofocus="autofocus" name="name", v-model="visitor_name" v-if="selected_visitor" disabled>
                                    <input type="text" class="form-control" placeholder="Visitors' full name" autofocus="autofocus" name="name", v-model="visitor_name" v-else>
                                    <label class="help-block text-danger" v-if="errors.visitor.name">@{{ errors.visitor.name }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            Company details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Select Company</label>
                                <div class="col-lg-10 col-md-10">
                                    <select name="company_id" id="company_id" class="form-control" v-model="company" @change="updateCompany">
                                    <option value="0" selected>Create new Company</option>
                                    <option v-for="company in companies" value="@{{ company.id }}">@{{ company.name }}</option>
                                    </select>
                                    <label class="help-block text-danger" v-if="errors.company">@{{ errors.company }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Name</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control" autofocus="autofocus" name="name", v-model="company_name" v-if="selected_company" disabled>
                                    <input type="text" class="form-control" placeholder="The company name" autofocus="autofocus" name="name", v-model="company_name" v-else>
                                    <label class="help-block text-danger" v-if="errors.company.name">@{{ errors.company.name }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            Visit Details
                        </h5>
                    </div>
                    <div class="panel-body">
                        <form action="#" class="form-horizontal group-border hover-striped">
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Select Contact Person</label>
                                <div class="col-lg-10 col-md-10">
                                    <select name="company_id" id="company_id" class="form-control" v-model="employee_id">
                                        <option value="0" selected>Select a contact person</option>
                                        <option v-for="employee in employees" value="@{{ employee.id }}">@{{ employee.name }}</option>
                                    </select>
                                    <label class="help-block text-danger" v-if="errors.employee_id">@{{ errors.employee_id }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Arrival</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control datetime-picker" placeholder="dd-mm-yyyy - hh:mm" autofocus="autofocus" name="expected_arrival", v-model="expected_arrival" v-else>
                                    <label class="help-block text-danger" v-if="errors.expected_arrival">@{{ errors.expected_arrival }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="name">Departure</label>
                                <div class="col-lg-10 col-md-10">
                                    <input type="text" class="form-control datetime-picker" placeholder="dd-mm-yyyy - hh:mm" autofocus="autofocus" name="expected_departure", v-model="expected_departure" v-else>
                                    <label class="help-block text-danger" v-if="errors.expected_departure">@{{ errors.expected_departure }}</label>
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
                                        <button class="btn btn-primary ml15" type="submit" @click="updateVisit($event)">Update visit</button>
                                    </template>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
@stop

@section('scripts')
    <script>
        $(".datetime-picker").datetimepicker({
            format: "dd-mm-yyyy - hh:ii"
        }).on('show', function(){
            $('.datetimepicker').find('th.prev>i').attr('class', '').addClass('en-arrow-left8');
            $('.datetimepicker').find('th.next>i').attr('class', '').addClass('en-arrow-right8');
        });
    </script>
@stop
