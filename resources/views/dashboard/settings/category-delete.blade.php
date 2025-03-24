@extends('dashboard.base')

@section('content')


<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>category List</h4>
                    </div>
                    <div class="card-body">
                        @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                        @endif

                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif

                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Create Date</th>
                                    <th style="text-align: center">
                                        Delete
                                    </th>
                                    <th style="text-align: center">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categoryList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td> {{ $item->fldCategoryType }}</td>
                                    <td> {{ $item->fldCreatedDate }}</td>
                                    <td style="text-align: center">
                                        <a href="{{ route('delete-category', $item->id) }}">
                                            <span class="badge badge-danger"
                                                style="padding-right: 15px;padding-left: 15px;cursor: pointer;">Delete</span>
                                        </a>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('edit_category_details', $item->id) }}">
                                            <span class="badge badge-warning"
                                                style="padding-right: 15px;padding-left: 15px;cursor: pointer;">Edit</span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" style="text-align: center;">
                                        ....&nbsp;&nbsp;&nbsp;&nbsp;No
                                        Record
                                        Found&nbsp;&nbsp;&nbsp;&nbsp;....</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-flex justify-content-center">
                            {{ $categoryList->links('pagination::bootstrap-4') }}
                </div> --}}

            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('javascript')

@endsection