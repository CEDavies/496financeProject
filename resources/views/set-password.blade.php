<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Password</title>
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
        input[type="password"], input[type="submit"] {
            margin-top: 15px;
            width: 90%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            background-color: #3b82f6;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Set Your Password</h1>

        <form method="POST" action="{{ route('password.set') }}">
            @csrf
            <input type="password" name="password" placeholder="New Password" required><br>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>
            <input type="submit" value="Save Password">
        </form>
    </div>

</body>
</html>
