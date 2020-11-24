@extends('layouts.app', ['page' => 'Edit Customer', 'pageSlug' => 'dmaddreturns', 'section' => 'dmaddreturns'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Customer</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dmaddreturns.show', $dmaddreturn) }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dmaddreturns.customer.update', ['dmaddreturn' => $dmaddreturn, 'addcustomerar' => $addcustomerar]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="card-body">

                            <div class="pl-lg-4">
                                <input type="hidden" name="dmaddreturn_id" value="{{ $dmaddreturn->id }}">
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
    <script>
        let input_qty = document.getElementById('input-qty');
        let input_price = document.getElementById('input-price');
        let input_total = document.getElementById('input-total');
        input_qty.addEventListener('input', updateTotal);
        input_price.addEventListener('input', updateTotal);
        function updateTotal () {
            input_total.value = (parseInt(input_qty.value) * parseFloat(input_price.value))+"$";
        }
    </script>
@endpush