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
              <a href="{{ route('admin.dashboard') }}" class="nav-link">
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
                  <div class="collapse {{ request()->is('all/type*') ? 'show' : '' }}" id="property_type">
                      <ul class="nav sub-menu">
                          <li class="nav-item">
                            <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
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
                          <a href="{{ route('all.amenities') }}" class="nav-link">All Amenities</a>
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
                        <a href="{{ route('all.property') }}" class="nav-link">All Property</a>
                      </li>
                      {{--
                      <li class="nav-item">
                        <a href="{{ route('add.property') }}" class="nav-link">All Property</a>
                      </li>
                      --}}
                    </ul>
                </div>
              </li>      


        </ul>
    </div>
    
</nav>

