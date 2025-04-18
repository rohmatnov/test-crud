<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - Tes CRUD</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>" />
</head>

<body>
    <div class="container" style="--width: 400px">
        <a href="<?= url('/') ?>" class="button button-secondary">Kembali</a>
        <div class="titlebar">
            <h1>Edit Mahasiswa #<?= esc($student->studentNumber) ?></h1>
        </div>

        <div>
            <form action="<?= url('/update/' . $student->id) ?>" method="POST">
                <div class="form-group">
                    <label for="student_number">NIM</label>
                    <input type="text" name="student_number" id="student_number" value="<?= old('student_number', $student->studentNumber) ?>" />

                    <?php if (isset($errors['student_number'])) : ?>
                        <div class="error-message">
                            <?= $errors['student_number'][0] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" value="<?= old('name', $student->name) ?>" />

                    <?php if (isset($errors['name'])) : ?>
                        <div class="error-message">
                            <?= $errors['name'][0] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone_umber">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number" value="<?= old('phone_number', $student->phoneNumber) ?>" />

                    <?php if (isset($errors['phone_number'])) : ?>
                        <div class="error-message">
                            <?= $errors['phone_number'][0] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="program_id">Program Studi</label>
                    <select name="program_id" id="program_id">
                        <option value="" selected hidden>Pilih Program Studi</option>
                        <?php foreach ($programs as $program) : ?>
                            <option value="<?= $program->id ?>" <?= old('program_id', $student->programId) == $program->id ? 'selected' : '' ?>><?= esc($program->name) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (isset($errors['program_id'])) : ?>
                        <div class="error-message">
                            <?= $errors['program_id'][0] ?>
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