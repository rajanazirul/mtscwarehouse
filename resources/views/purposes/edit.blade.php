@extends('layouts.app', ['page' => 'Edit Purpose', 'pageSlug' => 'purposes', 'section' => 'purposes'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Purpose Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('purposes.index') }}" class="btn btn-sm btn-primary">{{ __('Back to List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('purposes.update', $purpose) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Purpose information') }}</h6>
                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('purposename') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-purposepurpose">{{ __('Purpose Name') }}</label>
                                    <input type="text" name="purposename" id="input-purposename" class="form-control form-control-alternative{{ $errors->has('purposename') ? ' is-invalid' : '' }}" placeholder="{{ __('Purpose Name') }}" value="{{ old('purposename', $purpose->purposename) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'purposename'])
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
