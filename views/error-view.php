<?php

use Rohmat\CrudTest\FlashMessage;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= $code ?> - Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container">
        <div class="card stack">
            <h1>Oops! Terjadi Error (<?= $code ?>)</h1>
            <p>
                <?= $message ?>
            </p>
            <p>
                <a href="<?= url('/') ?>" class="button button-secondary">Ke Mahasiswa</a>
            </p>
        </div>
    </div>
</body>

</html>