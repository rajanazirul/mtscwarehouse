@extends('layouts.app', ['page' => 'Customers', 'pageSlug' => 'customers', 'section' => 'customers'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Customers</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">Add Customer</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Company Name</th>
                                <th>Company Address</th>
                                <th>Name</th>
                                <th>Email / Telephone</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->companyname }}</td>
                                        <td>{{ $customer->companyaddress }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}<br>{{ $customer->phone }}</a></td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Customer">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Customer" onclick="confirm('Are you sure to delete the customer') ? this.parentElement.submit() : ''">
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
                        {{ $customers->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
