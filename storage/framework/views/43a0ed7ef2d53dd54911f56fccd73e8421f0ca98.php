

<?php $__env->startSection('content'); ?>


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>Edit menu element</h4></div>
            <div class="card-body">
                <?php if(Session::has('message')): ?>
                    <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="<?php echo e(route('menu.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($menuElement->id); ?>" id="menuElementId"/>
                    <table class="table table-striped table-bordered datatable">
                        <tbody>
                            <tr>
                                <th>
                                    Menu
                                </th>
                                <td>
                                    <select class="form-control" name="menu" id="menu">
                                        <?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($menu1->id == $menuElement->menu_id  ): ?>
                                                <option value="<?php echo e($menu1->id); ?>" selected><?php echo e($menu1->name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($menu1->id); ?>"><?php echo e($menu1->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    User Roles
                                </th>
                                <td>
                                    <table class="table">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    $temp = false;
                                                    foreach($menuroles as $menurole){
                                                        if($role == $menurole->role_name){
                                                            $temp = true;
                                                        }
                                                    }
                                                    if($temp === true){
                                                        echo '<input checked type="checkbox" name="role[]" value="' . $role . '" class="form-control"/>';
                                                    }else{
                                                        echo '<input type="checkbox" name="role[]" value="' . $role . '" class="form-control"/>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo e($role); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <td>
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="<?php echo e($menuElement->name); ?>"
                                    placeholder="Name"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Type
                                </th>
                                <td>
                                    <select class="form-control" name="type" id="type">
                                        <?php if($menuElement->slug === 'link'): ?>
                                            <option value="link" selected>Link</option>
                                        <?php else: ?>
                                            <option value="link">Link</option>
                                        <?php endif; ?>
                                        <?php if($menuElement->slug === 'title'): ?>
                                            <option value="title" selected>Title</option>
                                        <?php else: ?>
                                            <option value="title">Title</option>
                                        <?php endif; ?>
                                        <?php if($menuElement->slug === 'dropdown'): ?>
                                            <option value="dropdown" selected>Dropdown</option>
                                        <?php else: ?>
                                            <option value="dropdown">Dropdown</option>
                                        <?php endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Other
                                </th>
                                <td>
                                    <div id="div-href">
                                        Href:
                                        <input 
                                            type="text" 
                                            name="href" 
                                            class="form-control" 
                                            placeholder="href"
                                            value="<?php echo e($menuElement->href); ?>"
                                        />
                                    </div>
                                    <br><br>
                                    <div id="div-dropdown-parent">
                                        Dropdown parent:
                                        <input type="hidden" id="parentId" value="<?php echo e($menuElement->parent_id); ?>"/>
                                        <select class="form-control" name="parent" id="parent">

                                        </select>
                                    </div>
                                    <br><br>
                                    <div id="div-icon">
                                        Icon - Find icon class in: 
                                        <a 
                                            href="https://coreui.io/docs/icons/icons-list/#coreui-icons-free-502-icons"
                                            target="_blank"
                                        >
                                            CoreUI icons documentation
                                        </a>
                                        <br>
                                        <input 
                                            class="form-control" 
                                            name="icon" 
                                            type="text" 
                                            placeholder="CoreUI Icon class - example: cil-bell"
                                            value="<?php echo e($menuElement->icon); ?>"
                                        >
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-primary" href="<?php echo e(route('menu.index', ['menu' => $menuElement->menu_id])); ?>">Return</a>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/axios.min.js')); ?>"></script> 
<script src="<?php echo e(asset('js/menu-edit.js')); ?>"></script> 



<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/editmenu/edit.blade.php ENDPATH**/ ?>