

<?php $__env->startSection('content'); ?>


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>Show menu element</h4></div>
            <div class="card-body">
                <?php if(Session::has('message')): ?>
                    <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?></div>
                <?php endif; ?>

                    <table class="table table-striped table-bordered datatable">
                        <tbody>
                            <tr>
                                <th>
                                    Menu
                                </th>
                                <td>
                                    <?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($menu1->id == $menuElement->menu_id  ): ?>
                                            <?php echo e($menu1->name); ?>

                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    User Roles
                                </th>
                                <td>
                                    <?php
                                        $first = true;
                                        foreach($menuroles as $menurole){
                                            if($first === true){
                                                $first = false;
                                            }else{
                                                echo ', ';
                                            }
                                            echo $menurole->role_name;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Type
                                </th>
                                <td>
                                    <?php echo e($menuElement->slug); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Href:
                                </th>
                                <td>
                                    <?php echo e($menuElement->href); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Dropdown parent:
                                </th>
                                <td>
                                    <?php
                                        if(isset($menuElement->parent_name)){
                                            echo $menuElement->parent_name;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Icon
                                </th>
                                <td>
                                    <i class="<?php echo e($menuElement->icon); ?>"></i>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php echo e($menuElement->icon); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="<?php echo e(route('menu.index', ['menu' => $menuElement->menu_id])); ?>">Return</a>
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
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/editmenu/show.blade.php ENDPATH**/ ?>