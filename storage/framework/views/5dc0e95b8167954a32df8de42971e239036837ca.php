

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-4">
                    
                <img src="<?php echo e(asset('img/AYS_logo.jpg')); ?>" alt="Logo" class="mb-3" style="width:80px; height:80px; border-radius: 50%; object-fit: cover;">


                    <h4 class="fw-normal mb-1">Log in to your account</h4>
                    <p class="text-muted small">Welcome to AYS! Please enter your details</p>
                </div>
    
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" 
                               placeholder="Enter your email" value="ays@gmail.com" required autofocus>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label text-muted small">Password</label>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none small">Forgot password?</a>
                        </div>
                        <input type="password" name="password" class="form-control form-control-lg" 
                               placeholder="Password" value="Ashan@123" required>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                       
                        
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark btn-lg">Sign in</button>
                    </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .form-control {
        padding: 12px 16px;
        border: 1px solid #E5E7EB;
    }
    .form-control:focus {
        border-color: #000;
        box-shadow: none;
    }
    .btn-dark {
        background-color: #000;
        border-color: #000;
    }
    .btn-outline-dark:hover {
        background-color: #f8f9fa;
        color: #000;
        border-color: #E5E7EB;
    }
    .d-grid {
    display: flex;
    justify-content: center;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.authBase', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\final project\AYS Biiling System\resources\views/auth/login.blade.php ENDPATH**/ ?>