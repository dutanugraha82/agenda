<nav class="mt-2" >
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size:14px">
    @if(auth()->user()->role == 'super_admin')
    <li class="nav-item">
      <a href="/superadmin" class="nav-link">      
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>Pengguna <i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/superadmin/pengguna/admin-univ" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Admin Universitas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/superadmin/pengguna/admin-unit" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Admin Unit</p>
          </a>
          </li>
        </ul>
    </li>
  
    <li class="nav-item">
      <a href="/adminuniv" class="nav-link">      
            <i class="nav-icon fas fa-building"></i>
            <p>Unit</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/adminuniv" class="nav-link">      
            <i class="nav-icon fas fa-hiking"></i>
            <p>Kegiatan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/adminuniv" class="nav-link">      
            <i class="nav-icon fas fa-user-friends"></i>
            <p>Media Sosial</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/adminuniv" class="nav-link">      
            <i class="nav-icon fas fa-globe"></i>
            <p>Situs</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/adminuniv" class="nav-link">      
        <i class="nav-icon fas fa-table"></i>
        <p>Reporting</p>
      </a>
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