<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirps</title>
    <style>
        :root {
            --bg-color: #f5f8fa;
            --card-bg: white;
            --text-color: #14171a;
            --border-color: #e1e8ed;
            --primary: #1da1f2;
            --secondary-text: #657786;
            --hover-bg: #e8f5fe;
        }
        
        [data-theme="dark"] {
            --bg-color: #15202b;
            --card-bg: #192734;
            --text-color: #ffffff;
            --border-color: #38444d;
            --primary: #1da1f2;
            --secondary-text: #8899a6;
            --hover-bg: #22303c;
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
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        h1 {
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
        }

        .bird-logo {
            font-size: 30px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
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

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-btn {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar-small {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-default-small {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 100;
            margin-top: 5px;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-item {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            border-radius: 10px;
        }

        .dropdown-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .dropdown-name {
            font-weight: bold;
            font-size: 14px;
        }

        .dropdown-email {
            font-size: 12px;
            color: var(--secondary-text);
        }

        .chirp-box {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
        }

        textarea {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px;
            resize: none;
            font-family: inherit;
            background: var(--bg-color);
            color: var(--text-color);
        }

        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .chirp {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid var(--border-color);
        }

        .chirp-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .chirp-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chirp-avatar-default {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .chirp-user-info {
            display: flex;
            flex-direction: column;
        }

        .chirp-name {
            font-weight: bold;
            color: var(--text-color);
            font-size: 15px;
        }

        .chirp-email {
            color: var(--secondary-text);
            font-size: 12px;
        }

        .chirp-time {
            margin-left: auto;
            color: var(--secondary-text);
            font-size: 12px;
        }

        .chirp-message {
            margin-left: 50px;
            font-size: 15px;
            line-height: 1.5;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
        }

        .login-prompt {
            text-align: center;
            color: var(--secondary-text);
            padding: 20px;
        }

        .login-prompt a {
            color: var(--primary);
            text-decoration: none;
        }

        .login-prompt a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span class="bird-logo">🐦</span> Chirps</h1>
        <div class="header-right">
            <button class="dark-mode-btn" onclick="toggleDarkMode()">🌙 Dark Mode</button>
            
            @auth
                <div class="user-dropdown">
                    <button class="user-btn" onclick="toggleDropdown()">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="user-avatar-small">
                        @else
                            <div class="avatar-default-small">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        @endif
                        {{ Auth::user()->display_name ?? Auth::user()->name }} ▼
                    </button>
                    <div class="dropdown-content" id="userDropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-name">{{ Auth::user()->name }}</div>
                            <div class="dropdown-email">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">👤 Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" class="btn" style="margin-top: 0; padding: 8px 15px; font-size: 14px;">Register</a>
            @endauth
        </div>
    </div>

    @auth
        <div class="chirp-box">
            <form action="{{ route('chirps.store') }}" method="POST">
                @csrf
                <textarea name="message" rows="3" placeholder="What's happening?" maxlength="280"></textarea>
                @error('message')
                    <p class="error">{{ $message }}</p>
                @enderror
                <br>
                <button type="submit" class="btn">Chirp</button>
            </form>
        </div>
    @else
        <div class="chirp-box login-prompt">
            <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to post a chirp!</p>
        </div>
    @endauth

    @forelse ($chirps as $chirp)
        <div class="chirp">
            <div class="chirp-header">
                @if($chirp->user)
                    @if($chirp->user->avatar)
                        <img src="{{ asset('storage/' . $chirp->user->avatar) }}" class="chirp-avatar">
                    @else
                        <div class="chirp-avatar-default">{{ strtoupper(substr($chirp->user->name, 0, 1)) }}</div>
                    @endif
                    <div class="chirp-user-info">
                        <span class="chirp-name">{{ $chirp->user->display_name ?? $chirp->user->name }}</span>
                        <span class="chirp-email">{{ $chirp->user->email }}</span>
                    </div>
                    <span class="chirp-time">{{ $chirp->created_at->diffForHumans() }}</span>
                @else
                    <div class="chirp-avatar-default">?</div>
                    <div class="chirp-user-info">
                        <span class="chirp-name">Unknown</span>
                    </div>
                @endif
            </div>
            <div class="chirp-message">{{ $chirp->message }}</div>
        </div>
    @empty
        <p style="text-align: center; color: var(--secondary-text); padding: 20px;">No chirps yet. Be the first!</p>
    @endforelse

    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user-btn') && !event.target.matches('.user-btn *')) {
                var dropdowns = document.getElementsByClassName('dropdown-content');
                for (var i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove('show');
                }
            }
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</body>
</html>