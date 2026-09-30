<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true);

    $userFound = null;

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $userFound = $user;
            break;
        }
    }

    if ($userFound === null) {
        echo "Email tidak ditemukan."; 
    } elseif (password_verify($password,$userFound['password'])) {
        $_SESSION['user'] = $userFound;
        echo "Login berhasil.";
    } else {
        echo "password salah.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0fdf9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            width: 350px;
            max-width: 90%;
            padding: 30px;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2{
            text-align: center;
            color: #0f766e;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 8px;
            background-color: #14b8a6;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0f766e;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Form Login</h2>

        <form method="POST">
            <label>Email:</label><br>
            <input type="email" name="email"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password"><br><br>

            <button type="submit">Login</button>
            <p>
                Belum punya akun?
                <a href="register.php">Daftar di sini</a>
            </p>
        </form>
    </div>
</body>
</html>
