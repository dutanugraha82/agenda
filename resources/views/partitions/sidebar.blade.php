<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-table"></i>
          <p>
            Report
          </p>
        </a>
      </li>
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
            <a href="/superadmin/data-unit" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Units Data</p>
            </a>
          </li>
        </ul>
      </li>
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
            <a href="pages/charts/chartjs.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Websites Data</p>
            </a>
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
            <a href="pages/UI/general.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Activities Data</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            Social Media
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/tables/simple.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Social Media Data</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/tables/data.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Unit Social Media Data</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item mt-5 d-block d-md-none">
        <form action="/logout" method="POST">
          @csrf
          <button style="letter-spacing:3px" class="btn btn-danger btn-block p-2"><b>Logout</b></button>
        </form>
      </li>
    </ul>
  </nav>