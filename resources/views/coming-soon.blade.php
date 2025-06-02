<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Website đang phát triển</title>
  <style>
    :root {
      --bg-light: #f4f4f4;
      --text-light: #333;
      --bg-dark: #1e1e1e;
      --text-dark: #f0f0f0;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: var(--bg-light);
      color: var(--text-light);
      transition: all 0.3s ease;
    }

    .container {
      text-align: center;
      padding: 2rem;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }

    .logo {
      width: 100px;
      height: auto;
      margin-bottom: 1rem;
    }

    .toggle-mode {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <h1>Website bán giày Anatas đang trong quá trình phát triển</h1>
    <p>Chúng tôi đang nỗ lực hoàn thiện. Vui lòng quay lại sau!</p>
    <button class="toggle-mode" onclick="toggleMode()">Chuyển chế độ</button>
  </div>

  <script>
    function toggleMode() {
      const body = document.body;
      const currentBg = getComputedStyle(body).backgroundColor;
      if (currentBg === 'rgb(244, 244, 244)') {
        body.style.backgroundColor = '#1e1e1e';
        body.style.color = '#f0f0f0';
      } else {
        body.style.backgroundColor = '#f4f4f4';
        body.style.color = '#333';
      }
    }
  </script>
</body>
</html>
