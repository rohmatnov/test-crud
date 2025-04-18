<?php

use Rohmat\CrudTest\FlashMessage;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi - Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container">
        <a href="<?= url('/') ?>" class="button button-secondary">Ke Mahasiswa</a>

        <div class="titlebar">
            <div>
                <h1>Program Studi</h1>
            </div>
            <div class="action">
                <a href="<?= url('programs/create') ?>" class="button button-primary">Tambah</a>
            </div>
        </div>

        <?php if (FlashMessage::has('success')) : ?>
            <div class="alert alert-success">
                <?= FlashMessage::get('success') ?>
            </div>
        <?php endif; ?>

        <?php if (FlashMessage::has('error')) : ?>
            <div class="alert alert-error">
                <?= FlashMessage::get('error') ?>
            </div>
        <?php endif; ?>
        <div>
            <table>
                <thead>
                    <tr>
                        <th class="white-space-nowrap" width="80px">Kode Prodi</th>
                        <th>Nama prodi</th>
                        <th class="white-space-nowrap" width="30px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($programs)) : ?>
                        <?php foreach ($programs as $program) : ?>
                            <tr>
                                <td><?= esc($program->code) ?></td>
                                <td><?= esc($program->name) ?></td>
                                <td class="white-space-nowrap">
                                    <a href="<?= url('programs/edit/' . $program->id) ?>">Edit</a> |
                                    <a href="javascript:void(0);" onclick="if(confirm('Yakin ingin menghapus data ini?')) window.location.href='<?= url('/programs/delete/' . $program->id) ?>'" style="color: var(--error)">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">Data prodi belum ada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>