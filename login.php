<?php
require_once 'functions.php';

if (isLoggedIn()) {
    header('Location: profile.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Все поля обязательны для заполнения';
    } else {
        if (loginUser($username, $password)) {
            header('Location: profile.php');
            exit;
        } else {
            $error = 'Неверное имя пользователя или пароль';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background:
                radial-gradient(circle at 20% 20%, #4a4a4a 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, #3a3a3a 0%, transparent 40%),
                linear-gradient(135deg, #2b2b2b 0%, #1c1c1c 100%);
            color: #e6e6e6;
            padding: 20px;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }

        .card {
            position: relative;
            width: 100%;
            max-width: 420px;
            padding: 45px 35px 35px;
            background: linear-gradient(145deg, #3a3a3a, #2a2a2a);
            border-radius: 20px;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6d6d6d, #b0b0b0, #6d6d6d);
        }

        .card::after {
            content: "";
            position: absolute;
            top: -60px; right: -60px;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(255,255,255,0.06), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .title {
            margin: 0 0 5px;
            font-size: 26px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
            color: #f5f5f5;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            color: #9a9a9a;
            margin-bottom: 30px;
            letter-spacing: 0.3px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a8a8a8;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            color: #f0f0f0;
            background: #222;
            border: 1px solid #444;
            border-radius: 10px;
            outline: none;
            transition: all 0.25s ease;
            -webkit-appearance: none;
            appearance: none;
        }

        input::placeholder { color: #666; }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #8a8a8a;
            background: #1b1b1b;
            box-shadow: 0 0 0 3px rgba(180, 180, 180, 0.12);
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 8px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #1c1c1c;
            background: linear-gradient(145deg, #d4d4d4, #a3a3a3);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        button:hover {
            background: linear-gradient(145deg, #e4e4e4, #b8b8b8);
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.45);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
        }

        .error, .success {
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
            text-align: center;
            border: 1px solid transparent;
        }

        .error {
            color: #ff9a9a;
            background: rgba(200, 60, 60, 0.12);
            border-color: rgba(200, 60, 60, 0.35);
        }

        .success {
            color: #a4e5b4;
            background: rgba(60, 170, 100, 0.12);
            border-color: rgba(60, 170, 100, 0.35);
        }

        .footer-link {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: #8f8f8f;
        }

        .footer-link a {
            color: #dcdcdc;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 1px dashed #7a7a7a;
            transition: color 0.2s;
        }

        .footer-link a:hover { color: #ffffff; }

        /* --- Мобильная адаптация --- */
        @media (max-width: 480px) {
            body {
                padding: 12px;
                align-items: flex-start;
                padding-top: 24px;
                padding-bottom: 24px;
            }

            .card {
                padding: 32px 20px 26px;
                border-radius: 16px;
                max-width: 100%;
            }

            .title    { font-size: 22px; }
            .subtitle { margin-bottom: 22px; }

            /* 16px не даёт iOS Safari зумить при фокусе на поле */
            input[type="text"],
            input[type="password"] {
                font-size: 16px;
                padding: 14px;
            }

            button { padding: 15px; font-size: 16px; }
        }

        @media (max-width: 340px) {
            .card { padding: 26px 16px 22px; }
            .title { font-size: 20px; }
            label { font-size: 11px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="title">Авторизация</h2>
        <p class="subtitle">Войдите в свой аккаунт</p>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Имя пользователя</label>
                <input type="text" name="username" placeholder="Введите имя"
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" placeholder="Введите пароль" required>
            </div>

            <button type="submit">Войти</button>
        </form>

        <p class="footer-link">
            Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a>
        </p>
    </div>
</body>
</html>