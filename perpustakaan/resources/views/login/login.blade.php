<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Perpus SMKN1 Ktg</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="bg-img">
        <h1 class="content2 warna">Perpustakaan SMK Negeri 1 Ketapang</h1>
        <div class="content">
            <header>Login</header>
            <form action="/postlogin" method="post">
                @csrf
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="nik" required placeholder="NIK">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" class="pass-key" required placeholder="Password">
                    <span class="show">SHOW</span>
                </div>
                @if(session('error'))
                <div class="alert alert-danger" style="color: white;">
                    {{ session('error') }}
                </div>
                @endif
                <div class="field" style="margin-top: 40px;">
                    <input type="submit" value="LOGIN">
                </div>
            </form>
        </div>
    </div>
    <script>
        const pass_field = document.querySelector('.pass-key');
        const showBtn = document.querySelector('.show');
        showBtn.addEventListener('click', function() {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });
    </script>
</body>

</html>