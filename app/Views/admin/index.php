<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | PARKIR</title>
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
                            <a href="/admin" class="nav-link fs-6 active" aria-current="page">
                                <i class="bi bi-house-door-fill me-2"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kasir" class="nav-link fs-6 text-white" aria-current="page">
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
                        <h2 class="fw-bold fs-2">Home</h2>
                    </div>
                </div>
                <div class="row ms-4">
                    <div class="col">
                        <div class="mt-4">
                            <div class="text-center mt-3 mb-5 pb-3">
                                <h1 class="fw-bold">Data Parkir</h1>
                            </div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-4">
                                    <div class="bg-primary text-white text-center rounded align-middle border-dark" style="width: 250px; height:250px">
                                        <h2 class="py-3 display-6 fw-bold" style="border-bottom: 1px solid #fff">Kasir</h2>
                                        <h1 class="mt-4 fw-bold display-1"><?= $kasir; ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-success text-white text-center rounded align-middle border" style="width: 250px; height:250px">
                                        <h2 class="py-3 display-6 fw-bold" style="border-bottom: 1px solid #fff">Transaksi</h2>
                                        <h1 class="mt-4 fw-bold display-1"><?= $kendaraan; ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-warning text-white text-center rounded align-middle border" style="width: 250px; height:250px">
                                        <h2 class="py-3 display-6 fw-bold" style="border-bottom: 1px solid #fff">Member</h2>
                                        <h1 class="mt-4 fw-bold display-1"><?= $member; ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>