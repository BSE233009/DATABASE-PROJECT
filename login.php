<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login | Loan Management System</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Icons (Font Awesome) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <style>
    /* General body styles */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      color: #333;
    }

    /* Main container */
    .login-container {
      background: #fff;
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      animation: slide-in 0.5s ease-out;
    }

    /* Hero text and logo */
    .login-container .logo {
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 3rem;
      color: #007bff;
      margin-bottom: 1rem;
    }

    .login-container h2 {
      text-align: center;
      font-weight: 700;
      color: #333;
      margin-bottom: 1.5rem;
    }

    /* Form styles */
    .login-container form {
      width: 100%;
    }

    .login-container label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: block;
      color: #555;
    }

    .login-container input {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1.2rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .login-container input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .login-container .btn-login {
      width: 100%;
      padding: 0.8rem;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-container .btn-login:hover {
      background: #0056b3;
    }

    /* Footer text */
    .login-container .footer-text {
      text-align: center;
      font-size: 0.9rem;
      margin-top: 1.5rem;
    }

    .login-container .footer-text a {
      color: #007bff;
      text-decoration: none;
      font-weight: 600;
    }

    .login-container .footer-text a:hover {
      text-decoration: underline;
    }

    /* Animation for sliding in the login box */
    @keyframes slide-in {
      from {
        transform: translateY(50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    /* Responsive design */
    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }

      .login-container {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="logo">
      <i class="fas fa-university"></i>
    </div>
    <h2>Loan Management System</h2>
    <form id="login-form">
      <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required />
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>
    <p class="footer-text">
      Forgot your password? <a href="#">Click here</a>
    </p>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#login-form').submit(function(e) {
      e.preventDefault();
      $('.btn-login').attr('disabled', true).html('Logging in...');
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          if (resp == 1) {
            location.href = 'index.php?page=home';
          } else {
            alert('Invalid username or password.');
            $('.btn-login').removeAttr('disabled').html('Login');
          }
        },
        error: function(err) {
          console.error(err);
          alert('An error occurred. Please try again later.');
          $('.btn-login').removeAttr('disabled').html('Login');
        }
      });
    });
  </script>
</body>

</html>
