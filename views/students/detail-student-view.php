<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa: <?= esc($student->name) ?> - Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container" style="--width: 400px">
        <a href="<?= url('/') ?>" class="button button-secondary">Kembali</a>
        <div class="titlebar">
            <div>
                <h1>Detail Mahasiswa</h1>
            </div>
        </div>

        <div>
            <div class="card">
                <div>
                    <h3><?= esc($student->name) ?></h3>
                </div>
                <div class="separator"></div>
                <div>
                    <table>
                        <tr>
                            <th>NIM</th>
                            <td><?= esc($student->studentNumber) ?></td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td><?= esc($student->phoneNumber) ?></td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td><?= esc($student->program->name) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>