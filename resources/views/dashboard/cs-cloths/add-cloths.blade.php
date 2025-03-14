@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header   d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Add New Clothes</h4>
                        </div>
                        
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                            @endif

                            <form method="POST" action="{{ route('clothes.store') }}" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Clothes Model</label>
                                            <input name="model" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}"
                                                   type="text" placeholder="Enter clothes model"
                                                   value="{{ old('model') }}">
                                            @if ($errors->has('model'))
                                                <div class="invalid-feedback">{{ $errors->first('model') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Color</label>
                                            <select name="color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}">
                                                <option value="" disabled selected>Select color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}"
                                                        {{ old('color') == $color->id ? 'selected' : '' }}
                                                        data-color-code="{{ $color->color_code }}">
                                                        {{ $color->color_name }} ({{ $color->color_code }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('color'))
                                                <div class="invalid-feedback">{{ $errors->first('color') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Category</label>
                                            <select name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                                                <option value="" disabled selected>Select category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="form-group">
                                               <label class="font-weight-bold">Description</label>
                                               <textarea name="specifications" rows="4" 
                                                   class="form-control{{ $errors->has('specifications') ? ' is-invalid' : '' }}"
                                                   placeholder="Enter clothes description">{{ old('specifications') }}</textarea>
                                               @if ($errors->has('specifications'))
                                                   <div class="invalid-feedback">{{ $errors->first('specifications') }}</div>
                                               @endif
                                           </div>
                                       </div>
                                   </div>  

                                </div>


                                <!-- Sizes Section -->
                                <div class="mt-4">
                                    <h5 class="font-weight-bold border-bottom pb-2">Size Information</h5>
                                    <div id="chemical-container">
                                        <div class="chemical-row row mb-3">
                                            <div class="col-md-6">
                                                <select name="chemicals[0][id]" class="form-control">
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size->id }}">
                                                            {{ $size->gender }} ({{ $size->region }} {{ $size->alpha_sizes }} - {{ $size->common_formats }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" name="chemicals[0][quantity]" class="form-control"
                                                       placeholder="Quantity" step="0.01" required>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-block remove-chemical">Remove</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" id="add-chemical" class="btn btn-info">
                                            <i class="cil-plus"></i> Add Size
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 text-right border-top pt-3">
                                    <button class="btn btn-success" type="submit">
                                        <i class="cil-save"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // Function to check if the color is dark based on hex code brightness
        function isDarkColor(hex) {
            const hexColor = hex.replace('#', '');
            const r = parseInt(hexColor.substring(0, 2), 16);
            const g = parseInt(hexColor.substring(2, 4), 16);
            const b = parseInt(hexColor.substring(4, 6), 16);
            const brightness = 0.2126 * r + 0.7152 * g + 0.0722 * b;
            return brightness < 128; // If brightness is low, consider it a dark color
        }

        // Event listener to apply background color and text color to each option based on color code
        document.addEventListener('DOMContentLoaded', function() {
            const colorSelect = document.querySelector('select[name="color"]');
            const options = colorSelect.querySelectorAll('option');
            options.forEach(option => {
                const colorCode = option.getAttribute('data-color-code');
                if (colorCode) {
                    option.style.backgroundColor = colorCode;
                    option.style.color = isDarkColor(colorCode) ? 'white' : 'black';
                }
            });
        });

        // Event listener to add a new size row when button is clicked
        document.getElementById('add-chemical').addEventListener('click', function() {
            const container = document.getElementById('chemical-container');
            const index = container.children.length;
            const newRow = `
                <div class="chemical-row row mb-3">
                    <div class="col-md-6">
                        <select name="chemicals[${index}][id]" class="form-control">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">
                                    {{ $size->gender }} ({{ $size->region }} {{ $size->alpha_sizes }} - {{ $size->common_formats }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="chemicals[${index}][quantity]" class="form-control"
                               placeholder="Quantity" step="0.01" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-block remove-chemical">Remove</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newRow);
        });

        // Event listener to remove size row when "Remove" button is clicked
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-chemical')) {
                e.target.closest('.chemical-row').remove();
            }
        });
    </script>
@endsection
