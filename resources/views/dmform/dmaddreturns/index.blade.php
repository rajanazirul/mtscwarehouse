@extends('layouts.app', ['page' => 'Add Return Page', 'pageSlug' => 'dmaddreturns', 'section' => 'dmform'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Add and Returns DM Form</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('dmaddreturn.create') }}" class="btn btn-sm btn-primary">Add/Return DM</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>DO No.</th>
                            <th>Inv No.</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th></th>
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
                                    <td style="max-width:150px">{{ $dmaddreturn->dono }}</td>
                                    <td style="max-width:150px">{{ $dmaddreturn->invno }}</td>
                                    <td>{{ $dmaddreturn->products->count() }}</td>
                                    <td>{{ $dmaddreturn->products->sum('stock') }}</td>
                                    <td>
                                        @if($dmaddreturn->finalized_at)
                                            FINALIZED
                                        @else
                                            <span style="color:red; font-weight:bold;">TO FINALIZE</span>
                                        @endif
                                    </td>
                                    <td class="td-actions text-right">
                                        @if($dmaddreturnt->finalized_at)
                                            <a href="{{ route('dmaddreturns.show', ['dmaddreturn' => $dmaddreturn]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('dmaddreturns.show', ['dmaddreturn' => $dmaddreturn]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Receipt">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('dmaddreturns.destroy', $dmaddreturn) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete DM" onclick="confirm('Are you confirm to delete this?') ? this.parentElement.submit() : ''">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $receipts->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection
