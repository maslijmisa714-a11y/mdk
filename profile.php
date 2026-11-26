<?php
require_once 'functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();

if (!$user) {
    header('Location: logout.php');
    exit;
}

$username = isset($user['username']) ? $user['username'] : '';
$initial = $username !== '' ? substr($username, 0, 1) : '?';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
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
            max-width: 560px;
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

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 76px;
            height: 76px;
            margin: 0 auto 18px;
            border-radius: 50%;
            font-size: 30px;
            font-weight: 700;
            color: #1c1c1c;
            background: linear-gradient(145deg, #d4d4d4, #a3a3a3);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.45);
            text-transform: uppercase;
        }

        .title {
            margin: 0 0 5px;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
            color: #f5f5f5;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            color: #9a9a9a;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
        }

        .profile-info {
            background: #222;
            border: 1px solid #3a3a3a;
            border-radius: 14px;
            padding: 8px 20px;
            margin-bottom: 24px;
        }

        .profile-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px dashed #3a3a3a;
            font-size: 14px;
            gap: 12px;
        }

        .profile-row:last-child { border-bottom: none; }

        .profile-row .key {
            color: #9a9a9a;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .profile-row .value {
            color: #f0f0f0;
            font-weight: 500;
            max-width: 60%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: right;
        }

        .actions {
            display: flex;
            gap: 12px;
        }

        .btn-danger {
            display: block;
            width: 100%;
            padding: 13px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            color: #ffb3b3;
            background: rgba(200, 60, 60, 0.14);
            border: 1px solid rgba(200, 60, 60, 0.4);
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-danger:hover {
            background: rgba(200, 60, 60, 0.24);
            border-color: rgba(200, 60, 60, 0.6);
            color: #ffd0d0;
            transform: translateY(-1px);
        }

        /* --- Мобильная адаптация --- */
        @media (max-width: 560px) {
            body {
                padding: 12px;
                align-items: flex-start;
                padding-top: 24px;
                padding-bottom: 24px;
            }

            .card {
                padding: 32px 18px 26px;
                border-radius: 16px;
                max-width: 100%;
            }

            .avatar {
                width: 64px;
                height: 64px;
                font-size: 26px;
                margin-bottom: 14px;
            }

            .title    { font-size: 21px; }
            .subtitle { margin-bottom: 22px; }

            .profile-info { padding: 6px 14px; }

            .profile-row {
                font-size: 13px;
                padding: 10px 0;
                gap: 8px;
            }

            .profile-row .key   { font-size: 11px; }
            .profile-row .value { max-width: 62%; font-size: 13px; }

            .btn-danger { padding: 15px; font-size: 15px; }
        }

        @media (max-width: 380px) {
            .card { padding: 26px 14px 22px; }

            .profile-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 3px;
            }

            .profile-row .value {
                max-width: 100%;
                text-align: left;
                white-space: normal;
                overflow-wrap: break-word;
                word-break: break-word;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="avatar"><?php echo htmlspecialchars($initial); ?></div>
        <h2 class="title"><?php echo htmlspecialchars($username); ?></h2>
        <p class="subtitle">Ваш профиль</p>

        <div class="profile-info">
            <div class="profile-row">
                <span class="key">ID</span>
                <span class="value"><?php echo htmlspecialchars($user['id']); ?></span>
            </div>
            <div class="profile-row">
                <span class="key">Имя пользователя</span>
                <span class="value"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <div class="profile-row">
                <span class="key">Email</span>
                <span class="value"><?php echo htmlspecialchars($user['email']); ?></span>
            </div>
            <div class="profile-row">
                <span class="key">Дата регистрации</span>
                <span class="value"><?php echo htmlspecialchars($user['created_at']); ?></span>
            </div>
        </div>

        <div class="actions">
            <a href="logout.php" class="btn-danger">Выйти</a>
        </div>
    </div>
</body>
</html>