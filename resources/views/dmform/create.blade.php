@extends('layouts.app', ['page' => 'Register DM', 'pageSlug' => 'dmforms', 'section' => 'dmform'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New DM Form</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dmform.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dmform.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">DM Information</h6>
                           
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

                              
                               
                                <button type="submit" class="btn btn-success mt-4">Continue</button>
                           
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