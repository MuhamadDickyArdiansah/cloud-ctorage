<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/auth.css')}}">

</head>

<body>
  <div class="login-container">
    <div class="card">
      <h2>Login ke Cloud Storage</h2>
      <form action="{{ route('login') }}" id="loginForm" autocomplete="off" method="post" enctype="multipart/form-data">
        @csrf
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="password" required>
        <div class="d-flex gap-2">
          <p>Tidak punya akun? </p>
          <a href="/register">Register</a>
        </div>


        <button class="btn btn-dark d-flex right-0" type="submit">Login</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('js/auth.js')}}">

</body>

</html>