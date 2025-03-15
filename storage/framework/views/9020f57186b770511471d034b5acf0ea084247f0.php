

<?php $__env->startSection('css'); ?>
    <style>
        .card {
            border: none;
            border-radius: 0.375rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }

        .card-header h4 {
            font-size: 1.1rem;
            /*color: #334152;*/
        }

        /* Product Details Card */
        .card.mt-4 {
            background-color: #f8f9fc;
            margin: 0 1.25rem;
        }

        .card.mt-4 h5 {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4e73df;
        }

        .card.mt-4 label {
            font-size: 0.75rem;
            color: #858796;
            margin-bottom: 0.25rem;
        }

        .card.mt-4 p {
            font-size: 0.875rem;
            color: #3a3b45;
            margin-bottom: 0;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            font-size: 0.875rem;
            color: #6e707e;
        }

        .form-control {
            border-left: none;
            font-size: 0.875rem;
            height: calc(1.8em + 0.75rem + 2px);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .table {
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        .table th {
            border-top: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.03em;
            color: #6e707e;
            padding: 0.75rem;
        }

        .table td {
            vertical-align: middle;
            padding: 0.75rem;
            border-top: 1px solid #e3e6f0;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .btn {
            font-size: 0.875rem;
            font-weight: 400;
            padding: 0.375rem 0.75rem;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .btn-light {
            color: #3a3b45;
            background-color: #f8f9fc;
            border-color: #e3e6f0;
        }

        .btn-light:hover {
            background-color: #e3e6f0;
            border-color: #d1d3e2;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">

                        <div class="card-header   d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Set Product Pricing</h4>
                        </div>

                        <!-- Product Details Summary with Modern Card -->
                        <div class="card mt-4 mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="text-primary mb-4">Product Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted small">Item Name</label>
                                            <p class="font-weight-bold"><?php echo e($cloth[0]->item_name); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Color</label>
                                            <p class="font-weight-bold"><?php echo e($cloth[0]->color_name); ?> - <?php echo e($cloth[0]->color_code); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Category</label>
                                            <p class="font-weight-bold"><?php echo e($cloth[0]->category_name); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted small">Description</label>
                                            <p class="font-weight-bold">
                                                <?php echo e($cloth[0]->description); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0">
                            <form method="POST" action="<?php echo e(route('clothes.pricing.store', $cloth[0]->id)); ?>" class="form-horizontal">
                                <?php echo csrf_field(); ?>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-light">
                                        <tr>
                                            <th class="font-weight-bold">Size</th>
                                            <th class="font-weight-bold">Available Quantity</th>
                                            <th class="font-weight-bold">Dealer Price (Purchase)</th>
                                            <th class="font-weight-bold">Selling Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="align-middle font-weight-bold">
                                                    <?php echo e($size->gender); ?> (<?php echo e($size->region); ?> <?php echo e($size->alpha_sizes); ?> - <?php echo e($size->common_formats); ?>)
                                                </td>
                                                <input type="hidden" name="prices[<?php echo e($index); ?>][size_id]" value="<?php echo e($size->size_id); ?>">
                                                <td class="align-middle"><?php echo e($size->quantity); ?></td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rs</span>
                                                        </div>
                                                        <input type="number"
                                                               name="prices[<?php echo e($index); ?>][dealer_price]"
                                                               class="form-control"
                                                               step="0.01"
                                                               placeholder="0.00"
                                                               required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rs</span>
                                                        </div>
                                                        <input type="number"
                                                               name="prices[<?php echo e($index); ?>][selling_price]"
                                                               class="form-control"
                                                               step="0.01"
                                                               placeholder="0.00"
                                                               required>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4 text-right">
                                    <a href="#" class="btn btn-light btn-sm mr-2">
                                        <i class="cil-x"></i> Cancel
                                    </a>
                                    <button class="btn btn-primary btn-sm px-4" type="submit">
                                        <i class="cil-save mr-2"></i> Save Pricing
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

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\AYS Biiling System\resources\views/dashboard/cs-cloths/add-pricing.blade.php ENDPATH**/ ?>