@extends('dashboard.base')


@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Full Cloths Records</h4>
                        </div>
                        <div class="card-body table-responsive">

                            <table id="chemicalsTable" class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Cloth Name</th>
                                    <th style="text-align: center;width: 500px">Description</th>
                                    <th style="text-align: center">Category</th>
                                    <th style="text-align: center">Created Date</th>
                                    @if (auth()->user()->menuroles == 'manager,cashier,admin')
                                        <th style="text-align: center">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cloths as $cloth)
                                    <tr>
                                        <td>{{ $cloth->id }}</td>
                                        <td>{{ $cloth->item_name }}</td>
                                        <td>{{ $cloth->description }}</td>
                                        <td>{{ $cloth->category_name }}</td>
                                        <td>{{ $cloth->created_at }}</td>
                                        <td style="text-align: center">
                                            <a href="{{ route('clothes.details', $cloth->id) }}" class="creative-button btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('clothes.edit', $cloth->id) }}" class="creative-button btn btn-warning btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No cheques found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#chemicalsTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "ordering": true
            });
        });
    </script>
@endsection
