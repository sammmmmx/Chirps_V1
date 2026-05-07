<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Chirps</title>
    <style>
        :root {
            --bg-color: #f5f8fa;
            --card-bg: white;
            --text-color: #14171a;
            --border-color: #e1e8ed;
            --primary: #1da1f2;
            --secondary-text: #657786;
        }
        
        [data-theme="dark"] {
            --bg-color: #15202b;
            --card-bg: #192734;
            --text-color: #ffffff;
            --border-color: #38444d;
            --primary: #1da1f2;
            --secondary-text: #8899a6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bird-logo {
            font-size: 30px;
        }

        .dark-mode-btn {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
        }

        .card h2 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .avatar-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            margin-bottom: 10px;
        }

        .avatar-default {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            margin: 0 auto 10px;
            border: 3px solid var(--primary);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-color);
            color: var(--text-color);
            font-size: 14px;
        }

        input[type="file"] {
            padding: 10px 0;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .nav-links {
            margin-top: 20px;
            text-align: center;
        }

        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            margin: 0 10px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span class="bird-logo">🐦</span> Chirps</h1>
        <button class="dark-mode-btn" onclick="toggleDarkMode()">🌙 Dark Mode</button>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <!-- Profile Info Card -->
    <div class="card">
        <h2>Profile Information</h2>
        
        <div class="avatar-section">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar">
            @else
                <div class="avatar-default">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="avatar" accept="image/*">
                @error('avatar')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Display Name (shown on posts)</label>
                <input type="text" name="display_name" value="{{ Auth::user()->display_name }}" placeholder="{{ Auth::user()->name }}">
                @error('display_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>

    <!-- Change Password Card -->
    <div class="card">
        <h2>Change Password</h2>
        
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
                @error('current_password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Change Password</button>
        </form>
    </div>

    <div class="nav-links">
        <a href="{{ route('chirps.index') }}">← Back to Chirps</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-secondary" style="margin-left: 10px;">Logout</button>
        </form>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</body>
</html>