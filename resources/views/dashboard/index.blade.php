@extends('layouts.main')

@section('content')
    @include('_partials._title', ['title' => 'Dashboard'])

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-sx-12">
            <div class="item">
                <div class="tile green">
                    <div class="tile-icon">
                        <i class="ec-users s64"></i>
                    </div>
                    <div class="tile-content">
                        <div class="number countTo" data-from="0" data-to="325">325</div>
                        <h3>Visitors on-site</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
