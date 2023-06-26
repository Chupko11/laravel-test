@extends('back.layouts.auth-layout')
@section('pagetitle', isset($pageTitle) ? $pageTitle : 'Reset password')
@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Reset your password</h2>


          <div>
            <script>
                    function togglePasswordVisibility(){

                        const passwordInput = document.getElementById('password-input');
                        const icon = document.querySelector('.link-secondary svg');

                        if (passwordInput.type === 'password'){
                            passwordInput.type = 'text';
                        } else{
                            passwordInput.type = 'password';

                        }
                    }
                </script>



                @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>

                @endif
                <form method="post" action="{{ route('author.Loginrequest') }}" autocomplete="off" novalidate="">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                          Enter new Password
                        </label>
                        <div class="input-group input-group-flat">
                          <input type="password" class="form-control" placeholder="Your password" autocomplete="off" name="new_password">
                        </div>


                        @error('password')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                    <div class="mb-3">
                      <label class="form-label">
                        Confirm new Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="Your password" autocomplete="off" name="confirm_password">
                      </div>


                      @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>
                  </form>
            </div>

        </div>
    </div>
  </div>

@endsection
