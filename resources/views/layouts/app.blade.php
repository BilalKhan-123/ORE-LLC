<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background:#f3f4f6; }
        .admin-container { display:flex; }
        .admin-main { flex:1; padding:0; min-height:100vh; }

        /* Header */
        .admin-header { display:flex;align-items:center;justify-content:space-between;padding:12px 20px;background:#fff;border-bottom:1px solid #e5e7eb; }
        .admin-header .left { display:flex;align-items:center;gap:12px; }
        .admin-header .brand-title { font-weight:600;font-size:18px;color:#111827 }
        .admin-header .user-menu { display:flex;align-items:center;gap:12px }
        .admin-header .user-menu img { width:36px;height:36px;border-radius:50%;object-fit:cover }

        @media (max-width: 992px) {
            .admin-sidebar { position:fixed;z-index:1000;left:0;top:0;bottom:0; }
            .admin-main { margin-left:72px; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        @includeWhen(View::exists('admin.partials.sidebar'), 'admin.partials.sidebar')

        <main class="admin-main">
            <header class="admin-header">
                <div class="left">
                    <button id="headerSidebarToggle" title="Toggle sidebar" style="background:none;border:0;font-size:18px;cursor:pointer;color:#374151"><i class="fas fa-bars"></i></button>
                    <div class="brand-title">{{ config('app.name', 'Admin') }}</div>
                </div>

                <div class="user-menu">
                    @auth
                        <div style="text-align:right;margin-right:8px;">
                            <div style="font-weight:600">{{ Auth::user()->name ?? Auth::user()->email }}</div>
                            <small style="color:#6b7280">{{ Auth::user()->roles()->pluck('name')->first() ?? 'Admin' }}</small>
                        </div>
                        {{-- <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}" alt="avatar"> --}}
                        {{-- <div class="col-md-4 text-end"> --}}
                            <a target="_blank" href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">View Site</a>
                        {{-- </div> --}}
                        <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display:none;">@csrf</form>
                        <button onclick="event.preventDefault();document.getElementById('logoutForm').submit();" class="btn btn-sm btn-outline-danger">Logout</button>
                    @endauth
                </div>
            </header>

            <div style="padding:20px;">
                {{-- @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif --}}

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        (function(){
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            if(!sidebar || !toggle) return;

            // apply saved state
            if(localStorage.getItem('adminSidebarCollapsed') === '1'){
                sidebar.classList.add('collapsed');
            }

            toggle.addEventListener('click', function(){
                sidebar.classList.toggle('collapsed');
                const collapsed = sidebar.classList.contains('collapsed') ? '1' : '0';
                localStorage.setItem('adminSidebarCollapsed', collapsed);
            });
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor for all textareas with class 'rte-editor'
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea.rte-editor');
            textareas.forEach(function(element) {
                ClassicEditor
                    .create(element, {
                        toolbar: {
                            items: [
                                'undo', 'redo',
                                '|',
                                'formatting',
                                '|',
                                'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript',
                                '|',
                                'bulletedList', 'numberedList', 'outdent', 'indent',
                                '|',
                                'link', 'blockQuote', 'codeBlock', 'insertTable',
                                '|',
                                'imageUpload', 'mediaEmbed',
                                '|',
                                'alignment',
                                '|',
                                'removeFormat'
                            ]
                        },
                        htmlSupport: {
                            allow: [
                                {
                                    name: /.*/,
                                    attributes: true,
                                    classes: true,
                                    styles: true
                                }
                            ]
                        },
                        image: {
                            toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                        },
                        table: {
                            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                        },
                        height: '700px',
                        class: 'form-control'
                    })
                    .catch(error => console.error(error));
            });
        });
    </script>
    <script>
        (function(){
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            const headerToggle = document.getElementById('headerSidebarToggle');
            if(!sidebar) return;

            // apply saved state
            if(localStorage.getItem('adminSidebarCollapsed') === '1'){
                sidebar.classList.add('collapsed');
            }

            if(toggle){
                toggle.addEventListener('click', function(){
                    sidebar.classList.toggle('collapsed');
                    const collapsed = sidebar.classList.contains('collapsed') ? '1' : '0';
                    localStorage.setItem('adminSidebarCollapsed', collapsed);
                });
            }

            if(headerToggle){
                headerToggle.addEventListener('click', function(){
                    sidebar.classList.toggle('collapsed');
                    const collapsed = sidebar.classList.contains('collapsed') ? '1' : '0';
                    localStorage.setItem('adminSidebarCollapsed', collapsed);
                });
            }

            // responsive: auto-collapse on small screens
            function applyResponsive(){
                if(window.innerWidth < 992){
                    sidebar.classList.add('collapsed');
                } else {
                    if(localStorage.getItem('adminSidebarCollapsed') === '1'){
                        sidebar.classList.add('collapsed');
                    } else {
                        sidebar.classList.remove('collapsed');
                    }
                }
            }

            applyResponsive();
            window.addEventListener('resize', applyResponsive);
        })();
    </script>
