<img src="" alt="">
<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span>
        </button><a class="c-header-brand d-sm-none" href="#">
            
               <h5> Cotton Street Stock Management </h5>
        </a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown">

                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img"
                            src="https://drkavindajayawardena.lk//assets/img/avatars/user_image.png" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">

                    <form action="<?php echo e(url('/logout')); ?>" method="POST"> <?php echo csrf_field(); ?> <button type="submit"
                            class="btn btn-ghost-dark btn-block">Logout</button></form></a>
                </div>
            </li>
        </ul>
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <?php $segments = ''; ?>
                <?php for($i = 1; $i <= count(Request::segments()); $i++): ?>
                    <?php $segments .= '/' . Request::segment($i); ?>
                    <?php if($i < count(Request::segments())): ?>
                        <li class="breadcrumb-item"><?php echo e(Request::segment($i)); ?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active"><?php echo e(Request::segment($i)); ?></li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ol>
        </div>
    </header>
<?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/shared/header.blade.php ENDPATH**/ ?>