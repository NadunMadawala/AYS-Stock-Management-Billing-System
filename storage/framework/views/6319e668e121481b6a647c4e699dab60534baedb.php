<?php $__env->startSection('content'); ?>
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
                                    <?php if(auth()->user()->menuroles == 'manager,cashier,admin'): ?>
                                        <th style="text-align: center">Action</th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $cloths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cloth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($cloth->id); ?></td>
                                        <td><?php echo e($cloth->item_name); ?></td>
                                        <td><?php echo e($cloth->description); ?></td>
                                        <td><?php echo e($cloth->category_name); ?></td>
                                        <td><?php echo e($cloth->created_at); ?></td>
                                        <td style="text-align: center">
                                            <a href="<?php echo e(route('clothes.details', $cloth->id)); ?>" class="creative-button btn btn-primary btn-sm">View</a>
                                            <a href="<?php echo e(route('clothes.edit', $cloth->id)); ?>" class="creative-button btn btn-warning btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No cheques found</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-cloths/cloths-list.blade.php ENDPATH**/ ?>