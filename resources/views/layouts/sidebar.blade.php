
  <!-- ======= Sidebar ======= -->
  @role('admin')
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin') ? 'collapsed' : '' }}" href="/admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/roles/*') || request()->is('admin/permission/*') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-parent-line"></i><span>Quản lý phân quyền</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse {{ request()->is('admin/roles/*') || request()->is('admin/permission/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('roles.list') }}" class="{{ request()->is('admin/roles/list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách Roles</span>
            </a>
          </li>
          <li>
            <a href="{{ route('permission.list') }}" class="{{ request()->is('admin/permission/list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách Permission</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/team/*') || request()->is('admin/team/*') ? '' : 'collapsed' }}" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-account-circle-line"></i><span>Quản lý khu</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse {{ request()->is('admin/team/*') || request()->is('admin/team/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('team.index') }}" class="{{ request()->is('admin/team/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách khu</span>
            </a>
          </li>
          <!-- <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/list') ? '' : 'collapsed' }} " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-user-3-line"></i><span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{ request()->is('admin/list') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('user.list') }}" class="{{ request()->is('admin/list') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách</span>
            </a>
          </li>
          <!-- <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/gate/*') || request()->is('admin/gate/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-ancient-gate-line"></i><span>Quản lý ra vào cổng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse {{ request()->is('admin/gate/*') || request()->is('admin/gate/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('gate.note') }}" class="{{ request()->is('admin/gate/note') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Tạo tag ghi chú</span>
            </a>
          </li>
          <li>
            <a href="{{ route('gate.create') }}" class="{{ request()->is('admin/gate/create') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Tạo phiếu</span>
            </a>
          </li>
          <li>
            <a href="{{ route('gate.index') }}" class="{{ request()->is('admin/gate/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">Quản lý lịch nghỉ phép</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
  @endrole