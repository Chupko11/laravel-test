<header class="navbar navbar-expand-md navbar-light d-print-none sticky-top">
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href="{{ route('author.home') }}">
          <img src="./back/static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
      </h1>
      <div class="navbar-nav flex-row order-md-last">

        <?php
        $user = auth()->user();
        ?>
        <div class="nav-item dropdown">
            <a class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm" style="background-image: url('{{$user ? asset('storage/' . $user->picture) : ''}}')"></span>
                @if (auth()->check())
            <div class="d-none d-xl-block ps-2">
              <div>{{ $user->name }}</div>
              <div class="mt-1 small text-muted">UI Designer</div>
            </div>
            @endif
          </a>

          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ route('author.profile') }}" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('author.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
          <form action="{{ route('author.logout') }}" id="logout-form" method="POST">@csrf</form>
          </div>
        </div>

    </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
          <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('author.home') }}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Home
                  </span>
                </a>
              </li>


            <li class="nav-item dropdown">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('author.searchPost') }}" >
                <span class="nav-link-title">
                  View posts
                </span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >

                <span class="nav-link-title">
                  Posts
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ route('author.createPost') }}">
                      Add new post
                    </a>
                    <a class="dropdown-item" href="{{ route('author.showPosts') }}">
                      All posts
                    </a>
                  </div>
                </div>
              </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >

                  <span class="nav-link-title">
                    Tags
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                    

                    <a class="dropdown-item" href="{{ route('author.createTag') }}">
                    Add new tags
                    </a>
                      <a class="dropdown-item" href="{{ route('author.showTags') }}">
                        Show tags
                      </a>

                    </div>
                  </div>
                </div>
              </li>
              @if(auth()->user()->isAdmin())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >

                  <span class="nav-link-title">
                    Admin
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="{{ route('author.showUsersAdmin') }}">
                        Show all users
                      </a>
                      <a class="dropdown-item" href="{{route('author.showPostsAdmin')}}">
                        Show all posts
                      </a>
                      <a class="dropdown-item" href="{{ route('author.showTagsAdmin')}}">
                        Show all tags
                      </a>
                      <a class="dropdown-item" href="{{route('author.showCommentsAdmin')}}">
                        Show all Comments
                      </a>
                    </div>
                  </div>
                </div>
              </li>
              @endif




          </ul>
        </div>
      </div>
    </div>
  </header>
