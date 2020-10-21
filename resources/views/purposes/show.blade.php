@extends('layouts.app', ['page' => 'Edit purpose', 'pageSlug' => 'purposes', 'section' => 'purposes'])

@section('content')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purpose Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Purpose Name</th>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $purpose->id }}</td>
                                <td>{{ $purpose->purposename }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
@endsection