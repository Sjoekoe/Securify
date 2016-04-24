@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Keys'])

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <keyoverview></keyoverview>

            <template id="key-overview">
                <div class="panel panel-default" v-else>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Keys
                        </h4>
                        <div class="panel-controls">
                            <a href="#" class="panel-refresh" @click="refresh">
                            <i class="im-spinner6"></i>
                            </a>
                            <a href="{{ route('keys.create') }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body text-center" v-if="fetching">
                        <i class="fa fa-spinner fa-spin"></i>
                        <p>Loading ...</p>
                    </div>
                    <div class="panel-body" v-else>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Key Code</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="key in keys">
                                    <td>@{{ key.number }}</td>
                                    <td>@{{ key.name }}</td>
                                    <td>@{{ key.key_code }}</td>
                                    <td>@{{ key.description }}</td>
                                    <td>
                                        <a href="/keys/edit/@{{ key.id }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" @click="removeKey(key)">
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
