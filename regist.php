<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="shortcut icon" type="image/x-icon" href="dashboard/locked.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Register</title>
  </head>
  <body>
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 pb-3 pt-3 text-center">

              <form class="login-form" action="auth_reg.php" method="post">
                <div class="mb-md-4 mt-md-4 pb-2">
    
                  <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                  <p class="text-white-50 mb-5">Create a New Account!</p>

                  <div class="form-outline form-white mb-4">
                    <input type="text" id="typeEmailX" name="fullname" placeholder="Fullname" autofocus autocomplete="off" required class="form-control form-control-lg" />
                  </div>
    
                  <div class="form-outline form-white mb-4">
                    <input type="text" id="typeEmailX" name="username" placeholder="Username" autofocus autocomplete="off" required class="form-control form-control-lg" />
                  </div>
    
                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" name="password" placeholder="Password" required class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" name="confirm" placeholder="Confirm Password" required class="form-control form-control-lg" />
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" name="regist" type="submit">Register</button>
                  <p class="login-register-text"><br>Anda sudah punya akun? <a href="index.php">Login</a></p>
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</body>
</html>