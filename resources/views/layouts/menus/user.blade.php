<style>
.fe--home {
  display: inline-block;
  width: 1em;
  height: 1em;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='m12 5.561l-7 5.6V19h5v-4h4v4h5v-7.358a1 1 0 0 0-.375-.781zM12 3l7.874 6.3A3 3 0 0 1 21 11.641V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7.839A2 2 0 0 1 3.75 9.6z'/%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}
</style>

<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
          <img src="{{asset('logo/enterprise.png')}}" width="100%" height="auto">
        </a>
      </div>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span>
          </a>
        </li>
      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>Master</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
          <a href="#company" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">Company</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="company">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('companies.create')}}"><span class="ml-1 item-text">Add New</span>
              <a class="nav-link pl-3" href="{{route('companies.index')}}"><span class="ml-1 item-text">Company List</span> </a>
            </li>
          
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#employees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">Employees</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="employees">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('employees.create')}}"><span class="ml-1 item-text">Add Employees</span>
              <a class="nav-link pl-3" href="{{route('employees.index')}}"><span class="ml-1 item-text">list Employees</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    
     
    </nav>
</aside>