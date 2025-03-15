<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-header">
                    <h4>Cloth Details - <?php echo e($cloth->item_name); ?></h4>
                </div>
                <div class="card-body">

                    <!-- Basic Cloth Info Table -->
                    <table class="table table-bordered">
                        <tr><th>Cloth Name</th><td><?php echo e($cloth->item_name); ?></td></tr>
                        <tr><th>Description</th><td><?php echo e($cloth->description); ?></td></tr>
                        <tr><th>Category</th><td><?php echo e($cloth->category_name); ?></td></tr>
                        <tr><th>Color</th><td><span style="background-color: <?php echo e($cloth->color_code); ?>; padding: 5px 10px; color: white;"><?php echo e($cloth->color_name); ?></span></td></tr>
                        <tr><th>Created At</th><td><?php echo e($cloth->created_at); ?></td></tr>
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
                        <?php $__empty_1 = true; $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($size->gender); ?> (<?php echo e($size->region); ?> <?php echo e($size->alpha_sizes); ?> - <?php echo e($size->common_formats); ?>)</td>
                                <td><?php echo e($size->quantity); ?></td>
                                <td><?php echo e($size->purchase_price); ?></td>
                                <td><?php echo e($size->selling_price); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">No sizes found</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="<?php echo e(route('clothes.list')); ?>" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-cloths/cloth-full-details.blade.php ENDPATH**/ ?>