<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container-fluid main-container">

    <nav class="nav-container w-100 d-flex align-tems-center justify-content-center">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

          <a class="navbar-brand" href="https://github.com/sukantahui">
            <img src="./MEDIA/codernaccotax.png" alt="Logo" class="rounded-circle" width="40" height="40">
            <span class="brand-name ms-2"><strong>CNAT</strong></span>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-list ms-auto">
              <li class="nav-item">
                <a class="nav-link text-dark" href="./LOGIN"><strong>LOGIN</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link  text-dark" href="./SIGN-UP"><strong>SIGN UP</strong></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </nav>

    <div class="w-100 check-fluid">
      <div class="content">
        <div class="text"></div>
      </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <script>
      if (localStorage.getItem('rememberMyID')) {
        // alert("Got :"+localStorage.getItem('rememberMyID'));
        let rememberedId = localStorage.getItem('rememberMyID');

        fetch('set-session.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'myId=' + encodeURIComponent(rememberedId)
        }).then(() => {
          window.location.href = './MY-PROFILE';
        });
      }
    </script>
</body>

</html>