@extends('layouts.app', ['page' => 'Edit Product', 'pageSlug' => 'dmforms', 'section' => 'dmform'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Product</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dmform.show', $dmform) }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dmform.product.update', ['dmform' => $dmform, 'takenproduct' => $takenproduct]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="card-body">

                            <div class="pl-lg-4">
                                <input type="hidden" name="dmform_id" value="{{ $dmform->id }}">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Product</label>
                                    <select name="product_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($products as $product)
                                            @if($product['id'] == old('product_id') or $product['id'] == $takenproduct->product_id )
                                                <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }}</option>
                                            @else
                                                <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>


                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-qty">Quantity</label>
                                    <input type="number" name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('qty', $takenproduct->qty) }}" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
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