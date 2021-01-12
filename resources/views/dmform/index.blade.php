@extends('layouts.app', ['page' => 'DM Form', 'pageSlug' => 'dmform', 'section' => 'dmform'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">DM Form</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('dmform.create') }}" class="btn btn-sm btn-primary">New DM</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>DM</th>
                                <th>Date</th>
                                <th>Purpose</th>
                                <th>User</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($dmforms->sortByDesc('created_at') as $dmform)
                                    <tr>    
                                        <td>DM/{{ date('y', strtotime($dmform->created_at)) }}/D00{{ $dmform->id }}</td>
                                        <td>{{ date('d-m-y', strtotime($dmform->created_at)) }}</td>
                                        <td>
                                        @if($dmform->purpose_id)
                                            <a href="{{ route('purposes.show', $dmform->purpose) }}">{{ $dmform->purpose->purposename }}</a>
                                        @else
                                            N/A
                                        @endif
                                        </td>
                                        <td>{{ $dmform->user->name }}</td>
                                        <td>
                                            @if($dmform->status)
                                                {{$dmform->status}}
                                            @elseif($dmform->finalized_at)
                                                <span style="color:red; font-weight:bold;">PENDING ADMIN</span>
                                            @else
                                                <span style="color:red; font-weight:bold;">TO FINALIZE</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if (!$dmform->finalized_at)
                                                <a href="{{ route('dmform.show', ['dmform' => $dmform]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit dmform">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('dmform.show', ['dmform' => $dmform]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View dmform">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @endif
                                            <!--<form action="{{ route('dmform.destroy', $dmform) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete dmform" onclick="confirm('Are you sure you want to delete this dmform? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $dmforms->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
