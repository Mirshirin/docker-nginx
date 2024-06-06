<style>
  .search-form {
     width: 100%;
     color: black;   
   }  
 </style>
 
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('images/logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav">
        <li class="nav-item ">
          <form  class="search-form"  action="{{ route('search') }}" method="GET">
            <input type="text" name="query" placeholder="Search Products Title...">
            <button style="color: white"  type="submit">Search</button>
        </form>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown d-none d-lg-block">
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
            <h6 class="p-3 mb-0">Projects</h6>
            <div class="dropdown-divider"></div>
              
             
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-web text-info"></i>
                </div>
              </div>
              
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-layers text-danger"></i>
                </div>
              </div>
             
            </a>
           
        </li>
        
       
        
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
            <div class="navbar-profile">
              <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
            </div>
          </a>          
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">                    
       
              <div class="preview-item-content">
                <form method="POST" action="{{ route('logout') }}" style="  display: flex;  align-items: center;color:white">
                  @csrf
                  <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    <div class="preview-thumbnail" >
                                      <div class="preview-icon bg-dark ">
                                        
                                        <i class="mdi mdi-logout text-success">{{ __('Log Out') }}</i>
                                      
                                      </div>
                                    </div>
                    
                  </x-dropdown-link>
               </form>
              </div>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>