<nav class="navbar navbar-light bg-white fixed-top navbar-expand-sm ">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar-list-4">
            <form class="form-inline col-lg-10 col-md-8 ">
                <input class="form-control mr-sm-2 col-lg-10 col-md-8" type="search" placeholder="Search" aria-label="Search">
                <button class="btn text-white btn-green my-2 my-sm-0" type="submit">Search</button>
              </form>
          <ul class="navbar-nav">
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('images/admin/default-profile.jpg') }}" width="30" height="30" class="rounded-circle">
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