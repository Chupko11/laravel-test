@extends('back.layouts.auth-layout')
@section('pagetitle', isset($pageTitle) ? $pageTitle : 'signup')
@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Sign up</h2>
            <form action="{{ route('author.signupStore') }}" method="post">
                @csrf
                <div class="md-4">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name"  placeholder="Name">
                    </div>
                </div>

                <div class="md-4">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username"  placeholder="Username">
                    </div>
                </div>

                <div class="md-4">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="md-4">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password"  placeholder="Password">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Sign up</button>


            </form>


        </div>

    </div>
</div>

@endsection
