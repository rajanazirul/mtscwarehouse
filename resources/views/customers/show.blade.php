@extends('layouts.app', ['page' => 'Edit Customer', 'pageSlug' => 'customers', 'section' => 'customers'])

@section('content')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->companyname }}</td>
                                <td>{{ $customer->companyaddress }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
@endsection