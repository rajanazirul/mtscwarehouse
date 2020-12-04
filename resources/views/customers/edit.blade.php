@extends('layouts.app', ['page' => 'Edit Customer', 'pageSlug' => 'customers', 'section' => 'customers'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Customer Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('customers.index') }}" class="btn btn-sm btn-primary">{{ __('Back to List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('customers.update', $customer) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('companyname') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-companyname">{{ __('Company Name') }}</label>
                                    <input type="text" name="companyname" id="input-companyname" class="form-control form-control-alternative{{ $errors->has('companyname') ? ' is-invalid' : '' }}" placeholder="{{ __('Company Name') }}" value="{{ old('companyname', $customer->companyname) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'companyname'])
                                </div>

                                <div class="form-group{{ $errors->has('companyaddress') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-companyaddress">{{ __('Company Address') }}</label>
                                    <input type="text" name="companyaddress" id="input-companyaddress" class="form-control form-control-alternative{{ $errors->has('companyaddress') ? ' is-invalid' : '' }}" placeholder="{{ __('Company Address') }}" value="{{ old('companyaddress', $customer->companyaddress) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'companyaddress'])
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $customer->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $customer->email) }}" required>
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone', $customer->phone) }}" required>
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
