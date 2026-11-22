<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diskominfo Kabupaten Malang</title>
    <link rel="icon" href="img/ikon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        document.body.style.background = "url('img/kab1.png') no-repeat center center / cover";
    </script>



    <style>
        body {
            background: url('img/kab1.png') no-repeat center center fixed;
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: background 1s ease-in-out;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        .logo {
            height: 100px;
        }

        .container-main {
            text-align: center;
            margin-top: 210px;
            flex-grow: 1;
        }

        a {
            text-decoration: none;
        }

        .card-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: rgba(255, 255, 255, 0.8);
            color: black;
            border-radius: 10px;
            overflow: hidden;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="header">
        <img src="{{ asset('img/logo_kab.png') }}" alt="Logo Diskominfo" class="logo">
        <h2>DISKOMINFO KABUPATEN MALANG</h2>
    </div>

    <div class="container container-main">
        <h4>Sistem Informasi Pengolahan Arsip Diskominfo</h4>
        <a href="{{ url('login/superadmin') }}">
            <button class="btn btn-outline-light">Login Super Admin</button>
        </a>
        <a href="{{ url('login/admin_bidang') }}">
            <button class="btn btn-outline-light">Login Admin Bidang</button>
        </a>
        <a href="{{ url('login/user') }}">
            <button class="btn btn-outline-light">Login User</button>
        </a>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Berita Kabupaten Malang</h5>
                        <p class="card-text">Konten berita terbaru dari situs resmi Pemerintah kab Malang.</p>
                        <a href="https://bkpsdm.malangkab.go.id/" target="_blank" class="btn btn-primary">Baca
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer mt-5">
        <p>&copy; 2025 Diskominfo Kabupaten Malang</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>

</html>
