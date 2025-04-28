<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        img.avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .logout-btn {
            background-color: #ef4444;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="card">
        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="avatar">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are successfully logged in with Google.</p>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>

    <a href="{{ route('password.set-form') }}" class="logout-btn">Set Your Password</a>

</body>
</html>
