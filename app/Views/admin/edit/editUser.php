<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR | PARKIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body style="background-color: #eee;">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-md-3" style="margin-left: -15px;">
                <div class="d-flex flex-column flex-shrink-0 p-3 m-0 text-bg-dark vh-100">
                    <a href=" /admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="/img/simbol-parkir.jpg" alt="" width="40" height="45">
                        <span class="fs-4 ms-3">Dashboard</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link fs-6 text-white" aria-current="page">
                                <i class="bi bi-house-door-fill me-2"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kasir" class="nav-link active" aria-current="page">
                                <i class="bi bi-person-fill me-2"></i>
                                Kasir
                            </a>
                        </li>
                        <li>
                            <a href="/admin/transaksi" class="nav-link fs-6 text-white">
                                <i class="bi bi-journals me-2"></i>
                                Riwayat Transaksi
                            </a>
                        </li>
                        <li>
                            <a href="/admin/member" class="nav-link fs-6 text-white">
                                <i class="bi bi-credit-card me-2"></i>
                                Member
                            </a>
                        </li>
                        <li>
                            <a href="/admin/kategori" class="nav-link fs-6 text-white">
                                <i class="bi bi-credit-card me-2"></i>
                                Kategori
                            </a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="/logout" class="btn btn-danger mb-5 px-4 py-1 fs-5">Keluar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9" style="margin-left: -12px;">
                <div class="row py-3 vw-100" style="background-color: #ddd;">
                    <div class="col">
                        <h2 class="fw-bold fs-2">Edit Kasir</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="mt-4">
                            <form action="/kasir/update/<?= $kasir['id_user']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_user" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nm_user" name="nm_user" required autocomplete="off" value="<?= $kasir['nm_user']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required autocomplete="off" value="<?= $kasir['username']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="passwordLama" class="form-label">Password Lama <span style="color: red; font-size: smaller;">*hash</span></label>
                                    <input type="password" class="form-control" id="passwordLama" name="passwordLama" required autocomplete="off" value="<?= $kasir['password']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="passwordBaru" class="form-label">Password Baru <span style="color: red; font-size: smaller;">*boleh kosong</span></label>
                                    <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" autocomplete="off">
                                </div>
                                <div class="mb-4">
                                    <label for="role" class="form-label">Role</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" id="kasir" value="kasir" <?= ($kasir['role'] == 'kasir') ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="kasir">Kasir</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" id="admin" value="admin" <?= ($kasir['role'] == 'admin') ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="admin">Admin</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>