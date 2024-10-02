<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Easy<span>Learning</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">RealEstate</li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#property_type" role="button" aria-expanded="false" aria-controls="panel-1">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Property Type</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ request()->is('all/type') && !request()->is('all/property') ? 'show' : '' }}" id="property_type"> 
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all.type') }}" class="nav-link {{ request()->is('all/type') ? 'active' : '' }}">All Type</a>
            </li>
            {{-- 
            <li class="nav-item">
              <a href="{{ route('add.type') }}" class="nav-link">All Type</a>
            </li>
            --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false" aria-controls="panel-2">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Amenities Type</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="amenities">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all.amenities') }}" class="nav-link {{ request()->is('all/amenities') ? 'active' : '' }}">All Amenities</a>
            </li>
            {{-- 
            <li class="nav-item">
              <a href="{{ route('add.amenities') }}" class="nav-link">All Amenities</a>
            </li> 
            --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false" aria-controls="panel-3">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Property</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="property">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all.property') }}" class="nav-link {{ request()->is('all/property') ? 'active' : '' }}">All Property</a>
            </li>
            {{-- 
            <li class="nav-item">
              <a href="{{ route('add.property') }}" class="nav-link">All Property</a>
            </li>
            --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.package.history') }}" class="nav-link {{ request()->is('admin/package/history') ? 'active' : '' }}">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Package History</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.property.message') }}" class="nav-link {{ request()->is('admin/property/message') ? 'active' : '' }}">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Property Message </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false" aria-controls="emails">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Property State </span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="state">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all.state') }}" class="nav-link">All State</a>
            </li>
            {{-- <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Add State</a>
            </li> --}}
            
          </ul>
        </div>
      </li>


      <li class="nav-item nav-category">User All Function</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
          <i class="link-icon" data-feather="feather"></i>
          <span class="link-title">Manage Agent </span>
          <i class="link-arrow " data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="uiComponents">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all.agent') }}" class="nav-link {{ request()->is('all/agent') ? 'active' : '' }}">All Agent </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('add.agent') }}" class="nav-link">Add Agent</a>
            </li> --}}
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>