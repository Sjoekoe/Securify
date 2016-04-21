@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Visitors'])

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <visitstable></visitstable>

            <template id="visits-table">
                <div class="panel panel-default" v-else>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Expected Visitors
                        </h4>
                        <div class="panel-controls">
                            <a href="#" class="panel-refresh" @click="refresh">
                                <i class="im-spinner6"></i>
                            </a>
                            <a href="{{ route('visitors.create') }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body text-center" v-if="fetching">
                        <i class="fa fa-spinner fa-spin"></i>
                        <p>Loading ...</p>
                    </div>
                    <div class="panel-body" v-else>
                        <div class="alert alert-success fade in" v-if="success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="resetSuccessState">×</button>
                            <i class="fa-ok alert-icon s24"></i>
                            @{{ successMessage }}
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Visitor</th>
                                    <th>Company</th>
                                    <th>Expected arrival</th>
                                    <th>Expected departure</th>
                                    <th>Arrived at</th>
                                    <th>Departed at</th>
                                    <th>Contact Person</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="visit in visits" v-bind:class="{ 'green-bg': visit.is_completed }">
                                    <td>@{{ visit.visitorRelation.data.name }}</td>
                                    <td>@{{ visit.visitorRelation.data.companyRelation.data.name }}</td>
                                    <td>@{{ visit.expected_arrival | dateTimeFormat }}</td>
                                    <td>@{{ visit.expected_departure | dateTimeFormat }}</td>

                                    <td v-if="visit.arrival">
                                        @{{ visit.arrival | dateTimeFormat }}
                                    </td>
                                    <td v-else>
                                        <a href="#" @click="checkin($index, visit)">
                                            <i class="im-download"></i>
                                        </a>
                                    </td>

                                    <td v-if="visit.departure">
                                        @{{ visit.departure | dateTimeFormat }}
                                    </td>
                                    <td v-else>
                                        <a href="#" @click="checkout($index, visit)">
                                            <i class="im-upload" v-if="visit.arrival ? ! visit.departure : false"></i>
                                        </a>
                                    </td>

                                    <td>@{{ visit.employeeRelation.data.name }}</td>
                                    <td>
                                        <a href="/visitors/edit/@{{ visit.id }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" @click="removeVisitor(visit)">
                                            <i class="fa fa-remove"></i>
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
