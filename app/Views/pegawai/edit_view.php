<!doctype html>
<!-- dark mode -->
<html lang="en" data-bs-theme="dark">

<head>
    <title>Pegawai</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="container">
        <div class="card text-start mt-5">
            <div class="card">
                <div class="card-header text-center h3 p-3">
                    Tambah Data
                </div>
                <div class="card-body">
                    <!-- alert error -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- alert success -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('pegawai/' . $pegawai['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" value="<?= old('email', $pegawai['email']) ?>">
                            <small id="emailHelpId" class="form-text text-danger">
                                <?php if (session()->getFlashdata('errorInput')) : ?>
                                    <?= session()->getFlashdata('errorInput')['email'] ?>
                                <?php endif; ?>
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">nama</label>
                            <input type="nama" class="form-control" name="nama" id="nama" aria-describedby="helpId" placeholder="nama" value="<?= old('nama', $pegawai['nama']) ?>">
                            <small id="helpId" class="form-text text-danger">
                                <?php if (session()->getFlashdata('errorInput')) : ?>
                                    <?= session()->getFlashdata('errorInput')['nama'] ?>
                                <?php endif; ?>
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('pegawai') ?>" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>