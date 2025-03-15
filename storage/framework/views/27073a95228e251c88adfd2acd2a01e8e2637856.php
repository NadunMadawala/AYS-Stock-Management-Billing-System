

<?php $__env->startSection('content'); ?>


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>Menu roles</h4></div>
            <div class="card-body">
                <div class="row">
                    <a class="btn btn-lg btn-primary" href="<?php echo e(route('roles.create')); ?>">Add new role</a>
                </div>
                <br>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Hierarchy</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($role->name); ?>

                                </td>
                                <td>
                                    <?php echo e($role->hierarchy); ?>

                                </td>
                                <td>
                                    <?php echo e($role->created_at); ?>

                                </td>
                                <td>
                                    <?php echo e($role->updated_at); ?>

                                </td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo e(route('roles.up', ['id' => $role->id])); ?>">
                                        <i class="cil-arrow-thick-top"></i> 
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo e(route('roles.down', ['id' => $role->id])); ?>">
                                        <i class="cil-arrow-thick-bottom"></i>  
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('roles.show', $role->id )); ?>" class="btn btn-primary">Show</a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('roles.edit', $role->id )); ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                <form action="<?php echo e(route('roles.destroy', $role->id )); ?>" method="POST">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

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
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\cotton-street-stock-management\resources\views/dashboard/roles/index.blade.php ENDPATH**/ ?>