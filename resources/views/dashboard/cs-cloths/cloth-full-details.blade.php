@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-header">
                    <h4>Cloth Details - {{ $cloth->item_name }}</h4>
                </div>
                <div class="card-body">

                    <!-- Basic Cloth Info Table -->
                    <table class="table table-bordered">
                        <tr><th>Cloth Name</th><td>{{ $cloth->item_name }}</td></tr>
                        <tr><th>Description</th><td>{{ $cloth->description }}</td></tr>
                        <tr><th>Category</th><td>{{ $cloth->category_name }}</td></tr>
                        <tr><th>Color</th><td><span style="background-color: {{ $cloth->color_code }}; padding: 5px 10px; color: white;">{{ $cloth->color_name }}</span></td></tr>
                        <tr><th>Created At</th><td>{{ $cloth->created_at }}</td></tr>
                    </table>

                    <!-- Sizes with Pricing Form -->
                    <h5 class="mt-4">Available Sizes & Pricing</h5>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Dealer Price</th>
                            <th>Selling Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sizes as $size)
                            <tr>
                                <td>{{ $size->gender }} ({{ $size->region }} {{ $size->alpha_sizes }} - {{ $size->common_formats }})</td>
                                <td>{{ $size->quantity }}</td>
                                <td>{{ $size->purchase_price }}</td>
                                <td>{{ $size->selling_price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No sizes found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('clothes.list') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
