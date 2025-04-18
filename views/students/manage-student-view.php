<?php

use Rohmat\CrudTest\FlashMessage;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container">
        <div class="titlebar">
            <div>
                <h1>Mahasiswa</h1>
            </div>
            <div class="action">
                <a href="<?= url('programs') ?>" class="button button-secondary">Program Studi</a>
                <a href="<?= url('create') ?>" class="button button-primary">Tambah</a>
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
                        <th class="white-space-nowrap" width="80px">NIM</th>
                        <th>Nama</th>
                        <th class="white-space-nowrap" width="50px">Program Studi</th>
                        <th class="white-space-nowrap" width="30px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($students)) : ?>
                        <?php foreach ($students as $student) : ?>
                            <tr>
                                <td><?= esc($student->studentNumber) ?></td>
                                <td><?= esc($student->name) ?></td>
                                <td class="white-space-nowrap"><?= esc($student->program->name) ?? '-' ?></td>
                                <td class="white-space-nowrap">
                                    <a href="<?= url('show/' . $student->id) ?>">Detail</a> |
                                    <a href="<?= url('edit/' . $student->id) ?>">Edit</a> |
                                    <a href="javascript:void(0);" onclick="if(confirm('Yakin ingin menghapus data ini?')) window.location.href='<?= url('delete/' . $student->id) ?>'" style="color: var(--error)">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">Data mahasiswa belum ada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>