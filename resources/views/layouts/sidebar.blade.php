
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin') ? 'collapsed' : '' }}" href="/admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @role('admin')

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
    @endrole
      
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
            <a href="{{ route('gate.input') }}" class="{{ request()->is('admin/gate/input') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Nhập thông tin ra/vào cổng</span>
            </a>
          </li>
          <li>
            <a href="{{ route('gate.note') }}" class="{{ request()->is('admin/gate/note') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách thẻ ghi chú</span>
            </a>
          </li>
          <li>
            <a href="{{ route('gate.index') }}" class="{{ request()->is('admin/gate/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách ra/vào cổng</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
      @role('admin')
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/excel/*') || request()->is('admin/excel/*') ? '' : 'collapsed' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-file-excel-2-line"></i><span>Excel</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse {{ request()->is('admin/excel/*') || request()->is('admin/excel/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('excel.import') }}" class="{{ request()->is('admin/excel/import') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Import nhân viên</span>
            </a>
          </li>
          <!-- <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Icons Nav -->
      @endrole

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/permit/*') || request()->is('admin/permit/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav1" data-bs-toggle="collapse" href="#">
          <i class="ri-ancient-gate-line"></i><span>Quản lý phép</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav1" class="nav-content collapse {{ request()->is('admin/permit/*') || request()->is('admin/permit/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('permit.index') }}" class="{{ request()->is('admin/permit/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách phép</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/log/*') || request()->is('admin/log/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav2" data-bs-toggle="collapse" href="#">
          <i class="bx bxl-blogger"></i><span>Quản lý dữ liệu thay đổi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav2" class="nav-content collapse {{ request()->is('admin/log/*') || request()->is('admin/log/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('log.index') }}" class="{{ request()->is('admin/log/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách dữ liệu</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/email/*') || request()->is('admin/email/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav3" data-bs-toggle="collapse" href="#">
        <i class="bi bi-envelope"></i><span>Quản lý Email</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav3" class="nav-content collapse {{ request()->is('admin/email/*') || request()->is('admin/email/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('email.index') }}" class="{{ request()->is('admin/email/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách email</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/contest/*') || request()->is('admin/contest/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav4" data-bs-toggle="collapse" href="#">
        <i class="bi bi-ui-checks-grid"></i><span>Quản lý Cuộc thi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav4" class="nav-content collapse {{ request()->is('admin/contest/*') || request()->is('admin/contest/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('contest.index') }}" class="{{ request()->is('admin/contest/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách cuộc thi</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/system-error/*') || request()->is('admin/system-error/*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav5" data-bs-toggle="collapse" href="#">
        <i class="bi bi-receipt-cutoff"></i><span>Quản lý lỗi hệ thống</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav5" class="nav-content collapse {{ request()->is('admin/system-error/*') || request()->is('admin/system-error/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('system-error.index') }}" class="{{ request()->is('admin/system-error/index') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Danh sách lỗi</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- <li class="nav-heading">Quản lý lịch nghỉ phép</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li> -->
      <!-- End Profile Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li> -->
      <!-- End F.A.Q Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li> -->
      <!-- End Contact Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li> -->
      <!-- End Register Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li> -->
      <!-- End Login Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li> -->
      <!-- End Error 404 Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li> -->
      <!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->