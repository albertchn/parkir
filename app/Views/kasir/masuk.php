<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body style="background-color: #eee;">
    <div class="container-xl pt-3">
        <a href="/logout" class="text-dark text-decoration-none mb-0">
            <i class="bi bi-box-arrow-left"></i>
            Logout
        </a>
        <div class="row justify-content-center text-center mt-5">
            <div class="col-11">
                <h1 class="">Parkir Kendaraan</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card mx-auto" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center mt-2 mb-3">
                            <a href="/masuk" class="text-dark">Masuk</a> |
                            <a href="/keluar" class="text-dark text-decoration-none">Keluar</a>
                        </h5>
                        <?php if (session()->get('success')) : ?>
                            <div class="alert alert-success">
                                <?= session()->get('success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->get('danger')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->get('danger'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="/masuk/tambah" method="post">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <div class="row">
                                    <?php foreach ($kategori as $k) : ?>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="<?= $k['nm_kategori']; ?>" value="<?= $k['id_kategori']; ?>">
                                                <label class="form-check-label" for="<?= $k['nm_kategori']; ?>"><?= ucwords($k['nm_kategori']); ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="noPol" class="form-label">Nomor Polisi <span style="color: red; font-size: smaller;">*tanpa spasi</span></label>
                                <input type="text" class="form-control" id="noPol" name="noPol" required autocomplete="off" autofocus>
                            </div>
                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>