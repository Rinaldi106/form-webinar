<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Gagal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
        }

        h1 {
            color: #333;
            margin-top: 0;
        }

        p {
            color: #666;
            line-height: 1.5;
        }

        .error-icon {
            font-size: 48px;
            color: #E53935; /* Merah */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="error-icon">&#10060;</span> <!-- Simbol X -->
        <h1>Pendaftaran Gagal</h1>
        <p>Maaf, pendaftaran Anda gagal karena data yang Anda masukkan sudah terdaftar.</p>
    </div>
</body>
</html>
