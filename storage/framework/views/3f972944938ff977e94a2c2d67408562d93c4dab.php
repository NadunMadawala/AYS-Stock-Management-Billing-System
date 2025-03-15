<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>


        <div class="c-sidebar-brand">
            <h4 class="c-sidebar-brand-full"> AYS Clothing</h4>
            <h4 class="c-sidebar-brand-minimized"> AYS </h4>
            
        </div>
        <ul class="c-sidebar-nav">
        <?php if(isset($appMenus['sidebar menu'])): ?>
            <?php $__currentLoopData = $appMenus['sidebar menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($menuel['slug'] === 'link'): ?>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="<?php echo e(url($menuel['href'])); ?>">
                        <?php if($menuel['hasIcon'] === true): ?>
                            <?php if($menuel['iconType'] === 'coreui'): ?>
                                <i class="<?php echo e($menuel['icon']); ?> c-sidebar-nav-icon"></i>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo e($menuel['name']); ?>

                        </a>
                    </li>
                <?php elseif($menuel['slug'] === 'dropdown'): ?>
                    <?php renderDropdown($menuel) ?>
                <?php elseif($menuel['slug'] === 'title'): ?>
                    <li class="c-sidebar-nav-title">
                        <?php if($menuel['hasIcon'] === true): ?>
                            <?php if($menuel['iconType'] === 'coreui'): ?>
                                <i class="<?php echo e($menuel['icon']); ?> c-sidebar-nav-icon"></i>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo e($menuel['name']); ?>

                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
<?php /**PATH C:\final project\AYS Biiling System\resources\views/dashboard/shared/nav-builder.blade.php ENDPATH**/ ?>