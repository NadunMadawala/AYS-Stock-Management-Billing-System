@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Cloth</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('clothes.update', $cloth->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="item_name">Cloth Name</label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $cloth->item_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $cloth->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $cloth->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-success">Update Cloth</button>
                                <a href="{{ route('clothes.list') }}" class="btn btn-secondary">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
