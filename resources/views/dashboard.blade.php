@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])

@section('content')
    <div id="dashboard" class="row">
        <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">DM Issue Part</h4>
                        </div>
                    </div>
                </div>
                <app></app>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">DM Return Part</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <mainapp></mainapp>
        </div>
    </div>
    <script src="{{mix('/js/app.js')}}"></script>
@endsection
