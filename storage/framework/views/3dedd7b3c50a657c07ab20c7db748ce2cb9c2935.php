

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i><?php echo e(__('Users')); ?>

                            <div style="text-align: right">
    
                                    <a href="<?php echo e(route('user-register')); ?>"
                                        class="btn btn-primary active mt-3"><?php echo e(__('Register')); ?></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Roles</th>
                                        <th>Email verified at</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->menuroles); ?></td>
                                            <td><?php echo e($user->email_verified_at); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('/users/' . $user->id)); ?>"
                                                    class="btn btn-block btn-primary">View</a>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(url('/users/' . $user->id . '/edit')); ?>"
                                                    class="btn btn-block btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <?php if($you->id !== $user->id): ?>
                                                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST">
                                                        <?php echo method_field('DELETE'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <button class="btn btn-block btn-danger">Delete User</button>
                                                    </form>
                                                <?php endif; ?>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\cotton-street-stock-management\resources\views/dashboard/admin/usersList.blade.php ENDPATH**/ ?>