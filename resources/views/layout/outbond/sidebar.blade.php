<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="/" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Inventory App</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    
    <li class="menu-item {{ request()->routeIs('outbound.index') ? 'active' : '' }}">
      <a href="{{ route('outbound.index') }}" class="menu-link">
        <i class="menu-icon tf-icons fas fa-boxes"></i>
        <div>Outbound List</div>
      </a>
    </li>

    
    <li class="menu-item {{ request()->routeIs('outbound.add') ? 'active' : '' }}">
      <a href="{{ route('outbound.add') }}" class="menu-link">
        <i class="menu-icon tf-icons fas fa-plus-circle"></i>
        <div>Add Autbound</div>
      </a>
    </li>

    <!-- Laporan outbound -->
    <li class="menu-item {{ request()->routeIs('outbound.laporan') ? 'active' : '' }}">
      <a href="{{ route('outbound.laporan') }}" class="menu-link">
        <i class="menu-icon tf-icons fas fa-file-alt"></i>
        <div>Laporan Outbound</div>
      </a>
    </li>

    <!-- Logout -->
    <li class="menu-item">
      <form action="{{ route('logout.action') }}" method="POST" class="w-100">
        @csrf
        <button type="submit" class="menu-link border-0 bg-transparent text-start w-100">
          <i class="menu-icon tf-icons bx bx-power-off"></i>
          <div>Logout</div>
        </button>
      </form>
    </li>
  </ul>
</aside>
