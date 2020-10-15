@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Latest Vistor</h5>
                            <h2 class="card-title">Total visitor today</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">DM List</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Items</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Visitors</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-12">
            <div class="card card-tasks">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Latest DM Update</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#transactionModal">
                                New DM form
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        ID No.
                                    </th>
                                    <th>
                                        Purpose
                                    </th>
                                    <th>
                                        Add/Deduct
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New DM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="d-flex justify-content-between">
                   <div class="row">
                        <div class="col-15">
                    <a href="" class="btn btn-sm btn-primary">On-site</a></a>
                    <a href="" class="btn btn-sm btn-primary">Calibration</a>
                    <a href="" class="btn btn-sm btn-primary">Consignment</a>
                    <a href="" class="btn btn-sm btn-primary">Internal transfer</a>
                    <a href="" class="btn btn-sm btn-primary">Assembly/In house repair</a>
                    <a href="" class="btn btn-sm btn-primary">External repair</a>
                    <a href="" class="btn btn-sm btn-primary">Sample</a>
                    <a href="" class="btn btn-sm btn-primary">Rental/loan/Demo</a>
                    <a href="" class="btn btn-sm btn-primary">PO status</a>
                    <a href="" class="btn btn-sm btn-primary">Add NEW stock</a>
                 
                    </div>
                        
                    </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
       
   
@endsection
