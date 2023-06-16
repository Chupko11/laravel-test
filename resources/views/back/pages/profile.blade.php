@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

<div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <span class="avatar avatar-md" style="background-image: url('{{ asset('storage/' . auth()->user()->picture) }}')"></span>
      </div>
      <div class="col-md-6">
        <h2 class="page-title">{{ Auth::user()->name }}</h2>
        <div class="page-subtitle">
          <div class="row">
            <div class="col-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
              <a href="#" class="text-reset">UI Designer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>


    <div class="row">
      <div class="card">

  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
      <li class="nav-item">
        <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal details</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-picture" class="nav-link" data-bs-toggle="tab">Change Profile picture</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-delete" class="nav-link" data-bs-toggle="tab">Delete Account</a>
      </li>
    </ul>
  </div>
</div>
</div>


  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="tabs-details">
        <div>
            <form method="post"  action="{{ route('author.update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ $user->name }}"></input>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="{{ $user->username }}"></input>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email"  placeholder="{{ $user->email }}"></input>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Biography</label>
                    <textarea class="form-control" name="biography" placeholder="{{ $user->biography }}"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
    </div>
  </div>


  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tabs-password">
      <form method="post" action="{{ route('author.postPasswordUpdate') }}">
      @csrf
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Old password</label>
                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old password ">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">New password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tabs-picture">
        <div>

        <div>
            <form method="post"  action="{{ route('author.pictureUpdate') }}">
                @csrf
                <input type="file" name="picture">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tabs-delete">
        <div>
            <form method="post"  action="{{ route('author.deleteAccount') }}">
                @csrf
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <button type="submit" class="btn btn-primary">Delete account</button>
            </form>
        </div>
      </div>
    </div>
  </div>






@endsection
