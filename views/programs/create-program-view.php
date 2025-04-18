<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program Studi - Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container" style="--width: 400px">
        <a href="<?= url('/programs') ?>" class="button button-secondary">Kembali</a>
        <div class="titlebar">
            <h1>Tambah Program Studi</h1>
        </div>

        <div>
            <form action="<?= url('/programs/store') ?>" method="POST">
                <div class="form-group">
                    <label for="code">Kode Prodi</label>
                    <input type="text" name="code" id="code" value="<?= old('code') ?>" />

                    <?php if (isset($errors['code'])) : ?>
                        <div class="error-message">
                            <?= $errors['code'][0] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="name">Nama Prodi</label>
                    <input type="text" name="name" id="name" value="<?= old('name') ?>" />

                    <?php if (isset($errors['name'])) : ?>
                        <div class="error-message">
                            <?= $errors['name'][0] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>