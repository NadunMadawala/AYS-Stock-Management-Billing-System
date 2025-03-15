

<?php $__env->startSection('content'); ?>


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>Menu roles</h4></div>
            <div class="card-body">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo e($role->name); ?>

                            </td>
                            <td>
                                <?php echo e($role->created_at); ?>

                            </td>
                            <td>
                                <?php echo e($role->updated_at); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>">Return</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\cotton-street-stock-management\resources\views/dashboard/roles/show.blade.php ENDPATH**/ ?>