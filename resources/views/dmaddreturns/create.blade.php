@extends('layouts.app', ['page' => 'Add/Return DM', 'pageSlug' => 'dmaddreturns', 'section' => 'dmaddreturns'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New DM</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dmaddreturns.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dmaddreturns.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Add/Return Information</h6>
                            <div class="pl-lg-4">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                <div class="form-group{{ $errors->has('purpose_id') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <label class="form-control-label" for="input-name">Purpose</label>
                                    <select name="purpose_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('purpose') ? ' is-invalid' : '' }}" required>
                                        @foreach ($purposes as $purpose)
                                            @if($purpose['id'] == old('purpose'))
                                                <option value="{{$purpose['id']}}" selected>{{$purpose['purposename']}}</option>
                                            @else
                                                <option value="{{$purpose['id']}}">{{$purpose['purposename']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'purpose_id'])
                                </div>

                               <!--No need DO & INV-->
                               <!-- <div class="form-group{{ $errors->has('dono') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">DO No.</label>
                                    <input type="text" name="dono" id="input-dono" class="form-control form-control-alternative{{ $errors->has('dono') ? ' is-invalid' : '' }}" placeholder="DO No." value="{{ old('dono') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'dono'])
                                </div>-->

                               <!-- <div class="form-group{{ $errors->has('invno') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-invno">Invoice No.</label>
                                    <input type="text" name="invno" id="input-invno" class="form-control form-control-alternative{{ $errors->has('invno') ? ' is-invalid' : '' }}" placeholder="Invoice No." value="{{ old('invno') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'invno'])
                                </div>-->

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Continue</button>
                                </div>
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