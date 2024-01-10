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
      <h2 class=" mb-4">Register ke Cloud Storage</h2>
      <form action="{{ route('register') }}" method="post" id="loginForm" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">name:</label>
          <input type="text" class="form-control custom-input" id="name" name="name" placeholder="name" required>
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="text" class="form-control custom-input" id="email" name="email" placeholder="email" required>
          @error('email')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control custom-input" id="password" name="password" placeholder="password" required>
          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <p class="mb-0">Sudah punya akun?</p>
          <a href="/login" class="mb-0">Login</a>
        </div>

        <button type="submit" class="btn btn-dark">Register</button>
      </form>
    </div>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('js/auth.js')}}">

</body>

</html>