<?= $this->extend('auth_user/layout_auth') ?>

<?= $this->section('content') ?>
<form class="login100-form validate-form" method="POST" action="<?= base_url('auth/registrasi') ?>">
    <span class="login100-form-title p-b-15">
        Registrasi
    </span>
    <?= csrf_field(); ?>

    <div class="<?= ($validation->hasError('nama')) ? 'wrap-input100-error' : 'wrap-input100 ' ?>">
        <input class="<?= ($validation->hasError('nama')) ? 'input100-error' : 'input100 ' ?>" type="text" name="nama" autocomplete="off" value="<?= old('nama'); ?>">
        <span class="<?= ($validation->hasError('nama')) ? 'focus-input100-error' : 'focus-input100 ' ?>"></span>
        <span class="<?= ($validation->hasError('nama')) ? 'label-input100-error' : 'label-input100 ' ?>">Nama</span>
    </div>
    <?php if ($validation->hasError('nama')) { ?>
        <small class="form-text text-danger mt-0 mb-2"><?= $validation->getError('nama') ?></small>
    <?php } ?>
    <div>

    </div>

    <div class="<?= ($validation->hasError('email')) ? 'wrap-input100-error' : 'wrap-input100 ' ?>">
        <input class="<?= ($validation->hasError('email')) ? 'input100-error' : 'input100 ' ?> email" type="text" name="email" autocomplete="off" value="<?= old('email'); ?>">
        <span class="<?= ($validation->hasError('email')) ? 'focus-input100-error' : 'focus-input100 ' ?>"></span>
        <span class="<?= ($validation->hasError('email')) ? 'label-input100-error' : 'label-input100 ' ?>">Email</span>
    </div>
    <?php if ($validation->hasError('email')) { ?>
        <small class="form-text text-danger mt-0 mb-2"><?= $validation->getError('email') ?></small>
    <?php } ?>
    <div>

    </div>


    <div class="<?= ($validation->hasError('password')) ? 'wrap-input100-error' : 'wrap-input100 ' ?>">
        <input class="<?= ($validation->hasError('password')) ? 'input100-error' : 'input100 ' ?>" type="password" name="password" autocomplete="off">
        <span class="<?= ($validation->hasError('password')) ? 'focus-input100-error' : 'focus-input100 ' ?>"></span>
        <span class="<?= ($validation->hasError('password')) ? 'label-input100-error' : 'label-input100 ' ?>">Password</span>
    </div>
    <?php if ($validation->hasError('password')) { ?>
        <small class="form-text text-danger mt-0 mb-2"><?= $validation->getError('password') ?></small>
    <?php } ?>

    <div class="<?= ($validation->hasError('password_confirm')) ? 'wrap-input100-error' : 'wrap-input100 ' ?>">
        <input class="<?= ($validation->hasError('password_confirm')) ? 'input100-error' : 'input100 ' ?>" type="password" name="password_confirm" autocomplete="off">
        <span class="<?= ($validation->hasError('password_confirm')) ? 'focus-input100-error' : 'focus-input100 ' ?>"></span>
        <span class="<?= ($validation->hasError('password_confirm')) ? 'label-input100-error' : 'label-input100 ' ?>">Ulangi
            Password</span>
    </div>
    <?php if ($validation->hasError('password_confirm')) { ?>
        <small class="form-text text-danger mt-0 mb-3"><?= $validation->getError('password_confirm') ?></small>
    <?php } ?>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
            Daftar
        </button>
    </div>

    <div class="col text-center mt-4">
        <a href="/login">Kembali Login</a>
    </div>

</form>

<?= $this->endSection() ?>