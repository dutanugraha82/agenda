<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        @if (auth()->user()->role == "admin_univ")
        <a href="/adminuniv" class="nav-link">
          
          @elseif(auth()->user()->role == "super_admin")
          <a href="/superadmin" class="nav-link">
            
            <i class="nav-icon fas fa-table"></i>
            <p>
              Report
            </p>
          </a>
        </li>
        @endif
      @if (auth()->user()->role == "admin_univ")
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Units
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/adminuniv/unit" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Units Data</p>
            </a> 
          </li>
          <li class="nav-item">
            <a href="/adminuniv/unit-socmed" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Unit Social Media Data</p>
            </a>
          </li>
        </ul>
      </li>
      @endif
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-globe"></i>
          <p>
            Websites
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            @if (auth()->user()->role == 'admin_univ')
            <a href="/adminuniv/website" class="nav-link">  
              <i class="far fa-circle nav-icon"></i>
              <p>Websites Data</p>
            </a>
            @elseif(auth()->user()->role == "admin_unit")
            <a href="/adminunit/website" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Websites Data</p>
            </a>
            @elseif(auth()->user()->role == "super_admin")
            <a href="/superadmin/website" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Websites Data</p>
            </a>
              @endif
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-calendar"></i>
          <p>
            Activities
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            @if (auth()->user()->role == 'admin_univ')
            <a href="/adminuniv/activities" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Activities Data</p>
            </a>
            @elseif(auth()->user()->role == "admin_unit")
            <a href="/adminunit/activities" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Activities Data</p>
            </a>
           @elseif(auth()->user()->role == "super_admin")
           <a href="/superadmin/activities" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Activities Data</p>
          </a>
            @endif
           
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-tag"></i>
          <p>
            Social Media
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            @if (auth()->user()->role == 'admin_univ')
            <a href="/adminuniv/social-media" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Social Media Data</p>
            </a>
            @elseif(auth()->user()->role == 'admin_unit')
            <a href="/adminunit/social-media" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Social Media Data</p>
            </a>
            @elseif(auth()->user()->role == 'super_admin')
            <a href="/superadmin/social-media" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Social Media Data</p>
            </a>
            @endif
          </li>
        </ul>
      </li>
      @if (auth()->user()->role == "super_admin")
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-people-arrows"></i>
          <p>
            Create User
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/superadmin/users" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Admin Univ</p>
            </a>
          </li>
        </ul>
      </li>
      @endif
      <li class="nav-item mt-5 d-block d-md-none">
        <form action="/logout" method="POST">
          @csrf
          <button style="letter-spacing:3px" class="btn btn-danger btn-block p-2"><b>Logout</b></button>
        </form>
      </li>
    </ul>
  </nav>