<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chirp</title>
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

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
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

        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
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
            font-size: 15px;
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

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span class="bird-logo">🐦</span> Edit Chirp</h1>
        <a href="{{ route('chirps.index') }}" style="color: var(--primary); text-decoration: none;">← Cancel</a>
    </div>

    <div class="card">
        <form action="{{ route('chirps.update', $chirp) }}" method="POST">
            @csrf
            @method('PUT')
            
            <textarea name="message" rows="4" maxlength="280">{{ old('message', $chirp->message) }}</textarea>
            @error('message')
                <p class="error">{{ $message }}</p>
            @enderror
            
            <div style="margin-top: 15px;">
                <button type="submit" class="btn">Update Chirp</button>
                <a href="{{ route('chirps.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</body>
</html>