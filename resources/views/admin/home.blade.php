<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: Figtree, sans-serif; background: #f3f4f6; }
            .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
            .navbar { background: white; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
            .navbar h1 { color: #333; font-size: 24px; }
            .navbar a { color: #ef4444; text-decoration: none; font-weight: 600; cursor: pointer; }
            .navbar a:hover { color: #dc2626; }
            .content { background: white; padding: 40px; border-radius: 8px; margin-top: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
            .content h2 { color: #333; margin-bottom: 20px; }
            .content p { color: #666; line-height: 1.6; }
            .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px; }
            .card { background: #f9fafb; padding: 20px; border-radius: 8px; border-left: 4px solid #ef4444; }
            .card h3 { color: #333; margin-bottom: 10px; }
            .card p { color: #666; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class="navbar">
            <h1>Dashboard</h1>
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; cursor: pointer;">
                    <a>Logout</a>
                </button>
            </form>
        </div>

        <div class="container">
            <div class="content">
                <h2>Welcome, {{ Auth::user()->first_name ?? Auth::user()->email }}!</h2>
                <p>You have successfully logged in to your account.</p>

                <div class="card-grid">
                    <div class="card">
                        <h3>Profile</h3>
                        <p>Manage your account information and settings</p>
                    </div>
                    <div class="card">
                        <h3>Dashboard</h3>
                        <p>View your activity and analytics</p>
                    </div>
                    <div class="card">
                        <h3>Settings</h3>
                        <p>Configure your preferences</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
