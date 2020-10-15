@extends('layouts.app', ['page' => 'Onsites', 'pageSlug' => 'onsites', 'section' => 'dmform'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Onsites</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('onsites.create') }}" class="btn btn-sm btn-primary">Register Onsite Job</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>User</th>
                                <th>Products</th>
                                <th>Total Stock</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($onsites as $onsite)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($onsite->created_at)) }}</td>
                                        <td><a href="{{ route('customers.show', $onsite->customer) }}">{{ $onsite->customer->name }}<br>{{ $onsite->customer->companyname }}</a></td>
                                        <td>{{ $onsite->user->name }}</td>
                                        <td>{{ $onsite->products->count() }}</td>
                                        <td>{{ $onsite->products->sum('qty') }}</td>
                                        <td>
                                            @if (!$onsite->finalized_at)
                                                <span class="text-danger">To Finalize</span>
                                            @else
                                                <span class="text-success">Finalized</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if (!$onsite->finalized_at)
                                                <a href="{{ route('onsites.show', ['onsite' => $onsite]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit onsite">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('onsites.show', ['onsite' => $onsite]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View onsite">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('onsites.destroy', $onsite) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete onsite" onclick="confirm('Are you sure you want to delete this onsite? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $onsites->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
