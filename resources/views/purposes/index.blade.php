@extends('layouts.app', ['page' => 'Purposes', 'pageSlug' => 'purposes', 'section' => 'purposes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Purposes</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('purposes.create') }}" class="btn btn-sm btn-primary">Add Purpose</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Purpose Name</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($purposes as $purpose)
                                    <tr>
                                        <td>{{ $purpose->purposename }}</td>
                                        
                                        <td class="td-actions text-right">
                                            <a href="{{ route('purposes.show', $purpose) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('purposes.edit', $purpose) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Purpose">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('purposes.destroy', $purpose) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Purpose" onclick="confirm('Are you sure to delete the purpose') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $purposes->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
