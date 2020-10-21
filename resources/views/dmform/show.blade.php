@extends('layouts.app', ['page' => 'Manage DM', 'pageSlug' => 'dmform', 'section' => 'dmform'])

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
                        @if (!$dmform->finalized_at)
                            <div class="col-4 text-right">
                                @if ($dmform->products->count() == 0)
                                    <form action="{{ route('dmform.destroy', $dmform) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Delete Purpose
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-primary" onclick="confirm('ATTENTION: Do you want to finalize it? Your records cannot be modified from now on.') ? window.location.replace('{{ route('dmform.finalize', $dmform) }}') : ''">
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
                            <th>User</th>
                            <th>Purpose</th>
                            <th>Products</th>
                            <th>Total Stock</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dmform->id }}</td>
                                <td>{{ date('d-m-y', strtotime($dmform->created_at)) }}</td>
                                <td>{{ $dmform->user->name }}</td>
                                <td>{{ $dmform->purpose->purposename }}</a></td>
                                <td>{{ $dmform->products->count() }}</td>
                                <td>{{ $dmform->products->sum('qty') }}</td>
                                <td>{!! $dmform->finalized_at ? 'Completed at<br>'.date('d-m-y', strtotime($dmform->finalized_at)) : (($dmform->products->count() > 0) ? 'TO FINALIZE' : 'ON HOLD') !!}</td>
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
                            <h4 class="card-title">products: {{ $dmform->products->sum('qty') }}</h4>
                        </div>
                        @if (!$dmform->finalized_at)
                            <div class="col-4 text-right">
                                <a href="{{ route('dmform.product.add', ['dmform' => $dmform->id]) }}" class="btn btn-sm btn-primary">Add</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($dmform->products as $taken_product)
                                <tr>
                                    <td>{{ $taken_product->product->id }}</td>
                                    <td><a href="{{ route('categories.show', $taken_product->product->category) }}">{{ $taken_product->product->category->name }}</a></td>
                                    <td><a href="{{ route('products.show', $taken_product->product) }}">{{ $taken_product->product->name }}</a></td>
                                    <td>{{ $taken_product->qty }}</td>
                                    <td class="td-actions text-right">
                                        @if(!$dmform->finalized_at)
                                            <a href="{{ route('dmform.product.edit', ['dmform' => $dmform, 'takenproduct' => $taken_product]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Details">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('dmform.product.destroy', ['dmform' => $dmform, 'takenproduct' => $taken_product]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete details" onclick="confirm('Are you sure to delete this?') ? this.parentElement.submit() : ''">
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