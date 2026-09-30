<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'] ;

    if (empty($name) || empty($email) || empty($password)) {
        echo "semua data wajib diisi.";
    } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid.";
    } else {

    $password = password_hash($password,PASSWORD_DEFAULT);
    $users= json_decode(file_get_contents('users.json'), true);

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            echo "Email sudah terdaftar.";
            exit;
        }
    }

    $user = [
        "name" => $name,
        "email" => $email,
        "password" => $password
    ];

    $users[] = $user;

    file_put_contents(
        'users.json',
        json_encode($users, JSON_PRETTY_PRINT)
    );

    echo "Registrasi berhasil.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

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
        <h2>Form Registrasi</h2>

        <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="name"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Daftar</button>
        <p>
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </p>
    </form>
</div>
</body>
</html>