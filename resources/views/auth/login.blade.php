@extends('dashboard.authBase')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-4">
                    <!-- Logo updated to be circular -->
                    <img src="{{ asset('assets/images/AYS_logo.jpg') }}" alt="AYS Logo" width="100" height="100" class="mb-3 rounded-circle">

                    <h4 class="fw-normal mb-1">Log in to your account </h4>
                    <p class="text-muted small">Welcome back! Please enter your details</p>
                </div>
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" 
                               placeholder="Enter your email" value="ash@gmail.com" required autofocus>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label text-muted small">Password</label>
                            <a href="{{ route('password.request') }}" class="text-decoration-none small">Forgot password?</a>
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
                        <button type="button" class="btn btn-outline-dark btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" class="me-2">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                            </svg>
                            Sign in with Google
                        </button>
                        <button type="submit" class="btn btn-dark btn-lg">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
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
</style>
@endsection
