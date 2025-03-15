

<?php $__env->startSection('content'); ?>


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <?php if(Session::has('title')): ?>
                <h4><?php echo e(Session::get('title')); ?></h4>
                <?php endif; ?>
            </div>
            <div class="card-body">

                <?php if(Session::has('message')): ?>
                    <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?></div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert">Success</div>
                <?php endif; ?>
                
                <?php if(Session::has('back')): ?>
                    <?php if(Session::has('backParams')): ?>
                        <a href="<?php echo e(route( Session::get('back'), Session::get('backParams') )); ?>" class="btn btn-lg btn-primary">Return</a>
                    <?php else: ?>
                        <a href="<?php echo e(route( Session::get('back') )); ?>" class="btn btn-lg btn-primary">Return</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\AYS Biiling System\resources\views/dashboard/shared/universal-info.blade.php ENDPATH**/ ?>