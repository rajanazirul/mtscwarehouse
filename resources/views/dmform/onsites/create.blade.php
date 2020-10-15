@extends('layouts.app', ['page' => 'Register Onsite', 'pageSlug' => 'onsites', 'section' => 'dmform'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Onsite Purpose</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('onsites.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('onsites.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Customer information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('customer_id') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <label class="form-control-label" for="input-name">Customer</label>
                                    <select name="customer_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('customer') ? ' is-invalid' : '' }}" required>
                                        @foreach ($customers as $customer)
                                            @if($customer['id'] == old('customer'))
                                                <option value="{{$customer['id']}}" selected>{{$customer['name']}} - {{$customer['companyname']}}</option>
                                            @else
                                                <option value="{{$customer['id']}}">{{$customer['name']}} - {{$customer['companyname']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'customer_id'])
                                </div>

                                <button type="submit" class="btn btn-success mt-4">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush