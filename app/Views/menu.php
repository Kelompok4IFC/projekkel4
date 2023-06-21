<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Allan&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?= base_url('assets/Css/style.css') ?>">
    <title>Welcome to</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
    <script>
      window.addEventListener("DOMContentLoaded", () => {
        VANTA.BIRDS({
          el: "#vanta",
          mouseControls: true,
          touchControls: true,
          gyroControls: false,
          minHeight: 200.0,
          minWidth: 200.0,
          scale: 1.0,
          scaleMobile: 1.0,
          colorMode: "variance",
          birdSize: 1.2,
          quantity: 3.0,
          backgroundAlpha: 0.0,
          color1: 0x21a6c3,
          color2: 0x136d8c,
        });
        setTimeout(() => {
          document.querySelector("main").style.opacity = 1;
          document.querySelector("main").style.filter = none;
        }, 1000);
      });
    </script>
  </head>
  <body>
    <div id="video-background">
      </div>
    <div id="vanta"></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <main>
      <div class="container animate__animated animate__zoomIn">
    <!-- link tree button -->
          <div class="link">
            <a
            <a href="<?= site_url('Login') ?>"
              target="_blank"
              class="animate__animated animate__lightSpeedInLeft"
            >
              <img src="assets/img/2.png" alt="github" width="30"/> Login Sebagai Admin</a
            >
          </div>
          <div class="link">
            <a
            <a href="<?= site_url('LoginUser') ?>"
              target="_blank"
              class="animate__animated animate__lightSpeedInLeft"
            >
              <img src="assets/img/2.png" alt="github" width="30"/> Login Sebagai User</a
            >
          </div>
        <!-- footer -->
        <footer>
          <i class="animate__animated animate__wobble">made with Kelompok 4</i>
        </footer>
      </div>
    </main>
  </body>
</html>