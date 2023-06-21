<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-image: url('/assets/img/backround2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        } 
        .container {
            margin-top: 50px;
        }
        @media (max-width: 576px) {
            .container {
                margin-top: 10px;
                padding: 0 15px; /* Menambahkan padding pada container pada ukuran layar kecil */
            }
        }
        .card-header {
            font-size: 1.3rem;
        }
        @media (max-width: 576px) {
            .card-header {
                font-size: 1.2rem;
            }
        }
        .card {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            max-width: 650px; /* Menentukan ukuran maksimum card */
            margin: 0 auto; /* Membuat card berada di tengah */
            box-shadow: 0px 6px 8px black; /* Efek bayangan pada card */
            border-radius: 25px; /* Mengatur sudut lengkung pada card */
            padding: 100px; /* Menambahkan padding pada card */
            opacity: 0;
            transform: translateY(50px);
            animation: fadeIn 1s forwards;
            height: 720px; /* Tambahkan properti height dengan nilai yang sesuai */
        }
        .logo {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
            max-width: 200px;
            max-height: 200px;
            width: auto;
            height: auto;
            animation: logoAnimation 2s;
        }
        h3 {
            font-weight: bold; /* Mengatur teks "Login" menjadi tebal (bold) */
            color: black;
            font-family: "Brush Script MT", cursive; /* Menambahkan font "Brush Script MT" */
        }
        .form-group {
            width: 100%; /* Menyesuaikan lebar form-group dengan card */
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes logoAnimation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        #loginText {
            height: 40px; /* Menentukan tinggi tetap pada teks login */
            display: inline-block;
            overflow: hidden;
            }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <img src="assets/img/tekno.png" alt="Logo" class="logo">
		        <center><h3><span id="loginText"></span></h3></center>
                <form action="Loginuser" method="POST">
                    <?php if(session()->getFlashdata('error')){?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('error') ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="inputUsername" class="form-label">Username</label>
                        <input type="text" name="karyawan_username" class="form-control" value="<?php echo session()->getFlashdata('karyawan_username')?>" id="inputUsername" placeholder="Masukan Username....">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="karyawan_password" class="form-control" id="inputPassword" placeholder="Masukan Password.....">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" class="btn btn-success btn-block" value="LOGIN" style="border-radius: 8px;"/>
                    </div>
                </form>
            </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var loginText = $("#loginText");
        var text = "Login";
        var index = 0;
        var typingSpeed = 900; // Kecepatan pengetikan dalam milidetik (1000 = 1 detik)
        var deletingSpeed = 900; // Kecepatan penghapusan dalam milidetik (1000 = 1 detik)
        var cardHeight = $(".card").height(); // Simpan tinggi awal card
        var isDeleting = false; // Flag untuk menandakan apakah sedang dalam proses penghapusan teks

        function type() {
            if (!isDeleting && index < text.length) {
                loginText.append(text.charAt(index));
                index++;
                setTimeout(type, typingSpeed);
            } else if (isDeleting && index >= 0) {
                loginText.text(text.substring(0, index));
                index--;
                setTimeout(type, deletingSpeed);
            } else {
                isDeleting = !isDeleting;
                if (isDeleting) {
                    $(".card").height(cardHeight); // Setel tinggi card kembali ke tinggi awal saat mulai menghapus
                } else {
                    loginText.empty();
                    index = 0;
                }
                setTimeout(type, typingSpeed);
            }
        }

        type();
    });
</script>
</body>
</html>