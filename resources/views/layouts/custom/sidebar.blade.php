  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-surehelp sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            {{-- <i class="fas fa-laugh-wink"></i>
             --}}
             
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }} <sup>{{ 'USERNAME' }}</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Navigations
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Requests</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Request section:</h6>
                <a class="collapse-item" href="{{url("/dashboard")}}">New</a>
                <a class="collapse-item" href="{{url("/dashboard/request/view/approved")}}">Approved</a>
                <a class="collapse-item" href="{{url("/dashboard/request/view/rejected")}}">Rejected</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-user"></i>
            <span>Accounts</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Account section:</h6>
                <a class="collapse-item" href="{{url('/dashboard/account/create')}}">Add New Account</a>
                <a class="collapse-item" href="{{url('/dashboard/account/list')}}">Accounts</a>
                {{-- <a class="collapse-item" href="#">Rejected</a> --}}
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-handshake"></i>
            <span>Partnership Portal</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Partnership section:</h6>
                <a class="collapse-item" href="{{url('/dashboard/partners/broadcast-message')}}">Broadcast Message</a>
                <a class="collapse-item" href="{{url('/dashboard/partners/list-partners')}}">Partners</a>
                {{-- <a class="collapse-item" href="#">Rejected</a> --}}
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Free Shop</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Free Shop section:</h6>
                <a class="collapse-item" href="{{url('/dashboard/shop/manage')}}">Manage Shop</a>
                <a class="collapse-item" href="{{url('/dashboard/shop/wishlist')}}">Users Wishlist</a>
                {{-- <a class="collapse-item" href="#">Rejected</a> --}}
            </div>
        </div>
    </li>


     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-fw fa-quote-left"></i>
            <span>Users Testimonials</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users Testimonials section:</h6>
                <a class="collapse-item" href="{{route('testimonial.index')}}">Testimonials </a>
               
            </div>
        </div>
    </li>

    

  

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->