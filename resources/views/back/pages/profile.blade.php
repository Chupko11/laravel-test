@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

<div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <span class="avatar avatar-md" style="background-image: url(...)"></span>
      </div>
      <div class="col-md-6">
        <h2 class="page-title">Paweł Kuna</h2>
        <div class="page-subtitle">
          <div class="row">
            <div class="col-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
              <a href="#" class="text-reset">UI Designer at Tabler</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-auto d-md-flex">
        <a href="#" class="btn btn-primary">
          <!-- Download SVG icon from http://tabler-icons.io/i/message -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" /><path d="M8 9l8 0" /><path d="M8 13l6 0" /></svg>
            Change image
        </a>
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
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active show" id="tabs-details">
        <div>
            <form method="post"  action="{{ route('author.update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value='{{ $user->name }}' placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value='{{ $user->username }}' placeholder="Username">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email"  value='{{ $user->email }}' placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Biography</label>
                    <textarea class="form-control" name="biography" placeholder="Textarea placeholder">{{ $user->biography }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
      <div class="tab-pane" id="tabs-password">
        <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
      </div>
    </div>
  </div>

@endsection
