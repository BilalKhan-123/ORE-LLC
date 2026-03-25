<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <h3 class="brand-title">Admin</h3>
        <button id="sidebarToggle" title="Toggle sidebar" class="brand-toggle"><i class="fas fa-bars"></i></button>
    </div>

    <nav>
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="menu-section">Content</li>

            <li class="menu-item">
                <button class="menu-toggle" data-menu="services">
                    <span><i class="fas fa-concierge-bell menu-icon"></i>Services</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="services">
                    <a href="{{ url('/admin/services/create') }}" class="sub-link {{ Request::is('admin/services/create') ? 'active' : '' }}">Create</a>
                    <a href="{{ url('/admin/services') }}" class="sub-link {{ Request::is('admin/services*') ? 'active' : '' }}">All</a>
                </div>
            </li>

            <li class="menu-item">
                <button class="menu-toggle" data-menu="departments">
                    <span><i class="fas fa-sitemap menu-icon"></i>Departments</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="departments">
                    <a href="{{ url('/admin/departments/create') }}" class="sub-link {{ Request::is('admin/departments/create') ? 'active' : '' }}">Create</a>
                    <a href="{{ url('/admin/departments') }}" class="sub-link {{ Request::is('admin/departments*') ? 'active' : '' }}">All</a>
                </div>
            </li>

            <li class="menu-item">
                <button class="menu-toggle" data-menu="banners">
                    <span><i class="fas fa-image menu-icon"></i>Banners</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="banners">
                    <a href="{{ url('/admin/banners/create') }}" class="sub-link {{ Request::is('admin/banners/create') ? 'active' : '' }}">Create</a>
                    <a href="{{ url('/admin/banners') }}" class="sub-link {{ Request::is('admin/banners*') ? 'active' : '' }}">All</a>
                </div>
            </li>

            <li class="menu-item">
                <button class="menu-toggle" data-menu="faqs">
                    <span><i class="fas fa-question-circle menu-icon"></i>FAQs</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="faqs">
                    <a href="{{ url('/admin/faqs/create') }}" class="sub-link {{ Request::is('admin/faqs/create') ? 'active' : '' }}">Create</a>
                    <a href="{{ url('/admin/faqs') }}" class="sub-link {{ Request::is('admin/faqs*') ? 'active' : '' }}">All</a>
                </div>
            </li>

            <li class="menu-item">
                <button class="menu-toggle" data-menu="galleries">
                    <span><i class="fas fa-photo-video menu-icon"></i>Galleries</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="galleries">
                    <a href="{{ url('/admin/galleries/create') }}" class="sub-link {{ Request::is('admin/galleries/create') ? 'active' : '' }}">Create</a>
                    <a href="{{ url('/admin/galleries') }}" class="sub-link {{ Request::is('admin/galleries*') ? 'active' : '' }}">All</a>
                </div>
            </li>

            {{-- <li class="menu-item">
                <button class="menu-toggle" data-menu="testimonials">
                    <span><i class="fas fa-comments menu-icon"></i>Testimonials</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="menu-content" id="testimonials">
                    <a href="{{ url('/admin/testimonials') }}" class="sub-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}">All</a>
                </div>
            </li> --}}

            <li class="menu-section">Support</li>
            <li class="menu-item">
                <a href="{{ url('/admin/about') }}" class="nav-link {{ Request::is('admin/abouts*') ? 'active' : '' }}">
                    <i class="fas fa-address-book nav-icon"></i>
                    <span class="nav-text">About</span>
                </a>
                <a href="{{ url('/admin/contacts') }}" class="nav-link {{ Request::is('admin/contacts*') ? 'active' : '' }}">
                    <i class="fas fa-address-book nav-icon"></i>
                    <span class="nav-text">Contacts</span>
                </a>
                <a href="{{ url('/admin/user-contacts') }}" class="nav-link {{ Request::is('admin/user-contacts*') ? 'active' : '' }}">
                    <i class="fas fa-address-book nav-icon"></i>
                    <span class="nav-text">User Contacts</span>
                </a>
            </li>
        </ul>
    </nav>

    <style>
        /* Sidebar Container */
        .admin-sidebar {
            width: 250px;
            background: #1f2937;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            transition: width 0.2s ease;
        }

        /* Brand Section */
        .sidebar-brand {
            margin-bottom: 24px;
            text-align: center;
        }

        .brand-title {
            margin: 0;
            font-size: 18px;
        }

        .brand-toggle {
            background: none;
            border: 0;
            color: #9ca3af;
            margin-top: 8px;
            cursor: pointer;
        }

        /* Menu List */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 8px;
        }

        .menu-section {
            margin-top: 12px;
            font-weight: 600;
            color: #d1d5db;
            padding: 8px 0;
            list-style: none;
        }

        /* Navigation Links */
        .nav-link {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            width: 100%;
        }

        .nav-link.active {
            background: #111827;
        }

        .nav-icon {
            width: 20px;
        }

        .nav-text {
            margin-left: 10px;
        }

        /* Menu Toggle Buttons */
        .menu-toggle {
            background: none;
            border: 0;
            width: 100%;
            text-align: left;
            padding: 6px 0;
            cursor: pointer;
            color: #e5e7eb;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-toggle:hover {
            background: #374151;
            border-radius: 4px;
        }

        .menu-icon {
            width: 18px;
            margin-right: 8px;
        }

        .toggle-icon {
            font-size: 12px;
            transition: transform 0.2s ease;
        }

        .menu-toggle.open .toggle-icon {
            transform: rotate(180deg);
        }

        /* Submenu Content */
        .menu-content {
            margin-top: 6px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease;
        }

        /* Submenu Links */
        .sub-link {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 4px 0;
            padding-left: 26px;
        }

        .sub-link.active {
            color: #fff;
            background: #111827;
        }

        /* Collapsed State */
        .admin-sidebar.collapsed {
            width: 72px !important;
        }

        .admin-sidebar.collapsed .menu-toggle span,
        .admin-sidebar.collapsed .sub-link,
        .admin-sidebar.collapsed .brand-title {
            display: none;
        }

        .admin-sidebar.collapsed .menu-toggle {
            justify-content: center;
        }

        .admin-sidebar.collapsed .toggle-icon {
            display: none;
        }
    </style>

    <script>
        (function(){
            const toggles = document.querySelectorAll('.menu-toggle');
            
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function(e){
                    e.preventDefault();
                    const menuId = this.getAttribute('data-menu');
                    const content = document.getElementById(menuId);
                    const isOpen = this.classList.contains('open');
                    
                    // Close all other menus
                    toggles.forEach(t => {
                        if(t !== this){
                            t.classList.remove('open');
                            const id = t.getAttribute('data-menu');
                            document.getElementById(id).style.maxHeight = '0';
                        }
                    });
                    
                    // Toggle current menu
                    if(isOpen){
                        this.classList.remove('open');
                        content.style.maxHeight = '0';
                    } else {
                        this.classList.add('open');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
            
            // Auto-expand if a submenu item is active
            document.querySelectorAll('.menu-content').forEach(content => {
                if(content.querySelector('.sub-link.active')){
                    const id = content.id;
                    const toggle = document.querySelector(`[data-menu="${id}"]`);
                    toggle.classList.add('open');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        })();
    </script>
</aside>
