@extends('layouts.app', ['page' => 'Manage Onsite', 'pageSlug' => 'onsites', 'section' => 'dmform'])

@section('content')
    @include('alerts.success')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Onsite Summary</h4>
                        </div>
                        @if (!$onsite->finalized_at)
                            <div class="col-4 text-right">
                                @if ($onsite->products->count() == 0)
                                    <form action="{{ route('onsites.destroy', $onsite) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Delete Onsite
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-primary" onclick="confirm('ATTENTION: Do you want to finalize it? Your records cannot be modified from now on.') ? window.location.replace('{{ route('onsites.finalize', $onsite) }}') : ''">
                                        Finalize Onsite
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
                            <th>Customer</th>
                            <th>products</th>
                            <th>Total Stock</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $onsite->id }}</td>
                                <td>{{ date('d-m-y', strtotime($onsite->created_at)) }}</td>
                                <td>{{ $onsite->user->name }}</td>
                                <td><a href="{{ route('customers.show', $onsite->customer) }}">{{ $onsite->customer->name }}</a></td>
                                <td>{{ $onsite->products->count() }}</td>
                                <td>{{ $onsite->products->sum('qty') }}</td>
                                <td>{!! $onsite->finalized_at ? 'Completed at<br>'.date('d-m-y', strtotime($onsite->finalized_at)) : (($onsite->products->count() > 0) ? 'TO FINALIZE' : 'ON HOLD') !!}</td>
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
                            <h4 class="card-title">products: {{ $onsite->products->sum('qty') }}</h4>
                        </div>
                        @if (!$onsite->finalized_at)
                            <div class="col-4 text-right">
                                <a href="{{ route('onsites.product.add', ['onsite' => $onsite->id]) }}" class="btn btn-sm btn-primary">Add</a>
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
                            @foreach ($onsite->products as $taken_product)
                                <tr>
                                    <td>{{ $taken_product->product->id }}</td>
                                    <td><a href="{{ route('categories.show', $taken_product->product->category) }}">{{ $taken_product->product->category->name }}</a></td>
                                    <td><a href="{{ route('products.show', $taken_product->product) }}">{{ $taken_product->product->name }}</a></td>
                                    <td>{{ $taken_product->qty }}</td>
                                    <td class="td-actions text-right">
                                        @if(!$onsite->finalized_at)
                                            <a href="{{ route('onsites.product.edit', ['onsite' => $onsite, 'takenproduct' => $taken_product]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Details">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('onsites.product.destroy', ['onsite' => $onsite, 'takenproduct' => $taken_product]) }}" method="post" class="d-inline">
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