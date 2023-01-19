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
        <div class="row justify-content-center text-center mt-3">
            <div class="col">
                <h1 class="">Parkir Kendaraan</h1>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col">
                <div class="card mx-auto" style="width: 40rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center mt-2 mb-2">
                            <a href="/masuk" class="text-dark text-decoration-none">Masuk</a> |
                            <a href="/keluar" class="text-dark">Keluar</a>
                        </h5>
                        <?php if (session()->get('danger')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->get('danger'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->get('success')) : ?>
                            <div class="alert alert-success">
                                <?= session()->get('success'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="/keluar" method="post">
                            <div class="my-2">
                                <div class="row justify-content-end">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" autocomplete="off" placeholder="cari nomor polisi" autofocus>
                                            <button type="submit" class="btn btn-success" name="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="/keluar/bayar" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id_kendaraan" value="<?= ($kendaraan != false) ? $kendaraan['id_kendaraan'] : ''; ?>">
                                    <input type="hidden" name="id_kategori" value="<?= ($kendaraan != false) ? $kendaraan['id_kategori'] : ''; ?>">
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <input type="text" class="form-control" value="<?= ($kendaraan != false) ? $kendaraan['nm_kategori'] : ''; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_pol" class="form-label">Nomor Polisi <span style="color: red; font-size: smaller;">*tanpa spasi</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="no_pol" name="no_pol" value="<?= ($kendaraan != false) ? $kendaraan['no_pol'] : ''; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="member" class="form-label">Status Member</label>
                                        <input type="text" class="form-control" id="member" name="member" value="<?= ($kendaraan != false) ? $kendaraan['status_member'] : ''; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                                        <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= ($kendaraan != false) ? date('d-m-Y H:i:s', strtotime($kendaraan['jam_masuk'])) : ''; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                                        <input type="text" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= ($kendaraan != false) ? date('d-m-Y H:i:s', strtotime($jam_keluar)) : ''; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bayar" class="form-label">Bayar</label>
                                        <input type="text" class="form-control" id="bayar" name="bayar" value="<?= ($kendaraan != false) ? $bayar  : ''; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary">Bayar</button>
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