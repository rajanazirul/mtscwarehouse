@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h4 class="card-title">DM FORMS : ADD/RETURN</h4>
                        </div>
                        <div class="col-4 text-right">
                            
                        </div>
                       
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Purpose
                                    </th>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Type
                                    </th>

                                    

                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($dmaddreturns as $dmaddreturn)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($dmaddreturn->created_at)) }}</td>
                                    
                                    <td>
                                        @if($dmaddreturn->purpose_id)
                                            <a href="{{ route('purposes.show', $dmaddreturn->purpose) }}">{{ $dmaddreturn->purpose->purposename }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $dmaddreturn->products->count() }}</td>
                                    <td>{{ $dmaddreturn->type }}</td>
                                    
                                    <td class="td-actions text-right">
                                       
                                            <a href="{{ route('dmaddreturns.show', ['dmaddreturn' => $dmaddreturn]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h4 class="card-title">DM FORMS : DEDUCT/ISSUED</h4>
                        </div>
                        <div class="col-4 text-right">
                            
                        </div>
                       
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Purpose
                                    </th>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Type
                                    </th>

                                    

                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($dmforms as $dmform)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($dmform->created_at)) }}</td>
                                    
                                    <td>
                                        @if($dmform->purpose_id)
                                            <a href="{{ route('purposes.show', $dmform->purpose) }}">{{ $dmform->purpose->purposename }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $dmform->products->count() }}</td>
                                    <td>{{ $dmform->type }}</td>
                                    
                                    <td class="td-actions text-right">
                                       
                                            <a href="{{ route('dmform.show', ['dmform' => $dmform]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
   
@endsection
