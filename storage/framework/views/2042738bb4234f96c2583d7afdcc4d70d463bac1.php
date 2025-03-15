

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header   d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Add New Clothes</h4>
                        </div>
                        
                        <div class="card-body">
                            <?php if(Session::has('message')): ?>
                                <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?></div>
                            <?php endif; ?>

                            <?php if(Session::has('error')): ?>
                                <div class="alert alert-danger" role="alert"><?php echo e(Session::get('error')); ?></div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('clothes.store')); ?>" class="form-horizontal">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Clothes Model</label>
                                            <input name="model" class="form-control<?php echo e($errors->has('model') ? ' is-invalid' : ''); ?>"
                                                   type="text" placeholder="Enter clothes model"
                                                   value="<?php echo e(old('model')); ?>">
                                            <?php if($errors->has('model')): ?>
                                                <div class="invalid-feedback"><?php echo e($errors->first('model')); ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Color</label>
                                            <select name="color" class="form-control<?php echo e($errors->has('color') ? ' is-invalid' : ''); ?>">
                                                <option value="" disabled selected>Select color</option>
                                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($color->id); ?>"
                                                        <?php echo e(old('color') == $color->id ? 'selected' : ''); ?>

                                                        data-color-code="<?php echo e($color->color_code); ?>">
                                                        <?php echo e($color->color_name); ?> (<?php echo e($color->color_code); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('color')): ?>
                                                <div class="invalid-feedback"><?php echo e($errors->first('color')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Category</label>
                                            <select name="category" class="form-control<?php echo e($errors->has('category') ? ' is-invalid' : ''); ?>">
                                                <option value="" disabled selected>Select category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category') == $category->id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('category')): ?>
                                                <div class="invalid-feedback"><?php echo e($errors->first('category')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="form-group">
                                               <label class="font-weight-bold">Description</label>
                                               <textarea name="specifications" rows="4" 
                                                   class="form-control<?php echo e($errors->has('specifications') ? ' is-invalid' : ''); ?>"
                                                   placeholder="Enter clothes description"><?php echo e(old('specifications')); ?></textarea>
                                               <?php if($errors->has('specifications')): ?>
                                                   <div class="invalid-feedback"><?php echo e($errors->first('specifications')); ?></div>
                                               <?php endif; ?>
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
                                                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($size->id); ?>">
                                                            <?php echo e($size->gender); ?> (<?php echo e($size->region); ?> <?php echo e($size->alpha_sizes); ?> - <?php echo e($size->common_formats); ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
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
                            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($size->id); ?>">
                                    <?php echo e($size->gender); ?> (<?php echo e($size->region); ?> <?php echo e($size->alpha_sizes); ?> - <?php echo e($size->common_formats); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\cotton-street-stock-management\resources\views/dashboard/cs-cloths/add-cloths.blade.php ENDPATH**/ ?>