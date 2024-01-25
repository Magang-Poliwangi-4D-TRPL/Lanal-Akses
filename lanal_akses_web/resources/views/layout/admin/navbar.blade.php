<nav class="navbar navbar-light bg-white fixed-top navbar-expand-sm ">
    
    <div class="container px-3  ">
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar-list" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbar-list">
          <form  class="form-inline col-lg-10 col-md-8" action="
          @if (request()->is('admin/personil/*'))
            {{ route('admin.personil.search', ['page']) }} 
          @elseif (request()->is('admin/pegawai/*'))
            {{ route('admin.pegawai.search', ['page']) }}
          @elseif (request()->is('admin/users/*'))
            {{ route('admin.users.search', ['page']) }}
          @else
          @endif
          " method="GET">
            <input {{ request()->is('admin/absensi/*') ? 'disabled' : '' }} class="form-control mr-sm-2 col-lg-10 col-md-8" type="search" name="q" placeholder="Search" aria-label="Search" value="{{ request('q') }}"> 
            <button {{ request()->is('admin/absensi/*') ? 'disabled' : '' }} class="btn text-white bg-greenmain my-2 my-sm-0" type="submit">Search</button>
        </form>
        
          <ul class="navbar-nav">
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img src="{{ URL::asset('images/admin/default-profile.jpg') }}" class="rounded-circle nav-image">
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Edit Profile</a>
                <a class="dropdown-item" href="#">Log Out</a>
              </div>
            </li>   
          </ul>
        </div>
        
    </div>
  </nav>