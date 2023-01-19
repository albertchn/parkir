<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | PARKIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-color: #eee;">
    <div class="container">
        <div class="row wh-100 justify-content-center align-items-center vh-100">
            <div class="col-5 align-middle text-center">
                <form action="/login" method="post">
                    <img class="mb-4" src="/img/simbol-parkir.jpg" alt="" width="72" height="74">
                    <h1 class="h3 mb-3 fw-normal">LOGIN PARKIR</h1>

                    <?php if (session()->getFlashdata('danger')) : ?>
                        <div class="alert alert-danger my-3">
                            <?= session()->getFlashdata('danger'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" autocomplete="off" value="<?= old('username'); ?>">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?= old('password'); ?>">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
                    <p class="mt-5 mb-3 text-muted">© RPLA01 - 23</p>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>