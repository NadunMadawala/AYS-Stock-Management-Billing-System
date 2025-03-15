

<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> User <?php echo e($user->name); ?></div>
                    <div class="card-body">
                        <h4>Name: <?php echo e($user->name); ?></h4>
                        <h4>E-mail: <?php echo e($user->email); ?></h4>
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-block btn-primary"><?php echo e(__('Return')); ?></a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/admin/userShow.blade.php ENDPATH**/ ?>