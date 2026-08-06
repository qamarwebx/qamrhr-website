@php
use Illuminate\Support\Facades\Auth;
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login Basic - Pages')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
'resources/assets/js/pages-auth.js'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Login -->
      @if(Auth::check())
      <div class="alert alert-info" role="alert">
        You are already logged in.
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Logout</button>
        </form>
      </div>
      @else
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{url('/')}}" class="app-brand-link">
              <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
              <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
            </a>
          </div>


          <!-- /Logo -->
          <h4 class="mb-1">Welcome to {{ config('variables.templateName') }}! 👋</h4>
          <p class="mb-6">Please sign-in to your account and start the adventure</p>
          <script>
            const handleLogin = (e) => {
              e.preventDefault();
              const form = document.getElementById('formAuthenticationx');
              const formData = new FormData(form);
              fetch('/auth/login', {
                  method: 'POST',
                  body: formData,
                  headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  }
                })
                .then(response => {
                  if (response.redirected) {
                    window.location.href = response.url;
                  } else {
                    return response.json();
                  }
                })
                .then(data => {
                  if (data && !data.success) {
                    // Handle error, show message to user
                    alert(data.message || 'Login failed. Please try again.');
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  alert('An error occurred. Please try again.');
                });
            }
          </script>
          <!-- id="formAuthentication" -->
          <form id="formAuthenticationx" class="mb-4" onsubmit="handleLogin(event)">
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="my-8">
              <div class="d-flex justify-content-between">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                  <label class="form-check-label" for="remember-me">
                    Remember Me
                  </label>
                </div>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <p class="mb-0">Forgot Password?</p>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
            </div>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-6">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
              <i class="tf-icons ti ti-brand-facebook-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
              <i class="tf-icons ti ti-brand-twitter-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
              <i class="tf-icons ti ti-brand-github-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
              <i class="tf-icons ti ti-brand-google-filled"></i>
            </a>
          </div>
        </div>
      </div>
      @endif
      <!-- /Register -->
    </div>
  </div>
</div>
@endsection