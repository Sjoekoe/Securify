@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Employees'])

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <employeestable></employeestable>

            <template id="employees-table">
                <div class="panel panel-default" v-if="fetching">
                    <div class="panel-heading white-bg"></div>
                    <div class="panel-body text-center">
                        <i class="fa fa-spinner fa-spin"></i>
                        <p>Loading ...</p>
                    </div>
                </div>
                <div class="panel panel-default" v-else>
                    <div class="panel-heading white-bg"></div>
                    <div class="panel-heading-content">
                        <a href="{{ route('employees.create') }}" class="label label-success">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="per35">Employee</th>
                                        <th class="per15">Telephone</th>
                                        <th class="per15">Email</th>
                                        <th class="per15">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in employees">
                                        <td>@{{ employee.name }}</td>
                                        <td>@{{ employee.telephone }}</td>
                                        <td>@{{ employee.email }}</td>
                                        <td>
                                            <a class="text-muted" href="/employees/edit/@{{ employee.id }}">
                                                <i class="im-pencil"></i>
                                            </a>
                                            <a href="#" class="text-muted" @click="removeEmployee(employee)">
                                                <i class="im-remove2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
@stop
