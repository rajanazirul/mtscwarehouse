@extends('layouts.app', ['page' => 'Manage Add/Return', 'pageSlug' => 'dmaddreturns', 'section' => 'dmform'])


@section('content')
    @include('alerts.success')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">DM Summary</h4>
                        </div>
                        @if (!$dmaddreturn->finalized_at)
                            <div class="col-4 text-right">
                                @if ($dmaddreturn->products->count() === 0)
                                    <form action="{{ route('dmaddreturns.destroy', $dmaddreturn) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Delete DM
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-primary" onclick="confirm('ATTENTION: At the end of this DM you will not be able to load more products in it.') ? window.location.replace('{{ route('dmaddreturns.finalize', $dmaddreturn) }}') : ''">
                                        Finalize DM
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>DO No.</th>
                            <th>Inv No.</th>
                            <th>User</th>
                            <th>Products</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dmaddreturn->id }}</td>
                                <td>{{ date('d-m-y', strtotime($dmaddreturn->created_at)) }}</td>
                                <td>
                                    @if($dmaddreturn->purpose_id)
                                        <a href="{{ route('purposes.show', $dmaddreturn->purpose) }}">{{ $dmaddreturn->purpose->purposename }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td style="max-width:150px;">{{ $dmaddreturn->dono}}</td>
                                <td style="max-width:150px;">{{ $dmaddreturn->invno}}</td>
                                <td>{{ $dmaddreturn->user->name }}</td>
                                <td>{{ $dmaddreturn->products->count() }}</td>
                                <td>{{ $dmaddreturn->products->sum('stock') }}</td>
                                <td>{!! $dmaddreturn->finalized_at ? 'Finalized' : '<span style="color:red; font-weight:bold;">TO FINALIZE</span>' !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">products: {{ $dmaddreturn->products->count() }}</h4>
                        </div>
                        @if (!$dmaddreturn->finalized_at)
                            <div class="col-4 text-right">
                                <a href="{{ route('dmaddreturns.product.add', ['dmaddreturn' => $dmaddreturn]) }}" class="btn btn-sm btn-primary">Add</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($dmaddreturn->products as $addreturn_product)
                                <tr>
                                    <td><a href="{{ route('categories.show', $addreturn_product->product->category) }}">{{ $addreturn_product->product->category->name }}</a></td>
                                    <td><a href="{{ route('products.show', $addreturn_product->product) }}">{{ $addreturn_product->product->name }}</a></td>
                                    <td>{{ $addreturn_product->stock }}</td>
                                    <td class="td-actions text-right">
                                        @if(!$dmaddreturn->finalized_at)
                                            <a href="{{ route('dmaddreturns.product.edit', ['dmaddreturn' => $dmaddreturn, 'addreturnproduct' => $addreturn_product]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('dmaddreturns.product.destroy', ['dmaddreturn' => $dmaddreturn, 'addreturnproduct' => $addreturn_product]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Item" onclick="confirm('Are you sure to delete this item?') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/sweetalerts2.js"></script>
@endpush