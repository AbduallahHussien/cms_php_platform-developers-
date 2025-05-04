<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-0">
        <button class="sidebar-toggle d-lg-none me-2" type="button">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand" href="#">
            <span>{{ $documentation->name ?? 'DevDocs' }}</span>
        </a>
        
        {{-- <div class="d-flex align-items-center ms-auto">
            <div class="search-box d-none d-md-flex">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Search docs...">
            </div>
            
            <div class="d-flex align-items-center ms-3">
                <!-- User Profile -->
                <div class="dropdown">
                    <a href="#" class="user-profile" data-bs-toggle="dropdown">
                        <div class="d-none d-lg-block">
                            <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        </div>
                        <i class="bi bi-chevron-down ms-1 d-none d-lg-block"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Welcome, {{ auth()->user()->name }}!</h6></li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</nav>