@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-header">
                Select an account
            </h1>
            <selectaccount></selectaccount>

            <template id="select-account">
                <div class="list-group">
                    <template v-for="team in teams">
                        <a href="#" class="list-group-item">@{{ team.accountRelation.data.name }}</a>
                    </template>
                    <a href="#" class="list-group-item">Create new account ...</a>
                </div>
            </template>
        </div>
    </div>
@stop
