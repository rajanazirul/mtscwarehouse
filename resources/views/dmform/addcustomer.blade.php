@extends('layouts.app', ['page' => 'Add Customer', 'pageSlug' => 'dmform', 'section' => 'dmform'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add Customer</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dmform.show', [$dmform->id]) }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dmform.customer.store', $dmform) }}" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">
                                <input type="hidden" name="dmform_id" value="{{ $dmform->id }}">
                                <div class="form-group{{ $errors->has('customer_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-customer">Customer</label>
                                    <select name="customer_id" id="input-customer" class="form-select form-control-alternative{{ $errors->has('customer_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($customers as $customer)
                                            @if($customer['id'] == old('customer_id'))
                                                <option value="{{$customer['id']}}" selected>{{ $customer->name }} - {{ $customer->companyname }}</option>
                                            @else
                                                <option value="{{$customer['id']}}">{{ $customer->name }} - {{ $customer->companyname }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'customer_id'])
                                </div>

                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        });
    </script>

@endpush