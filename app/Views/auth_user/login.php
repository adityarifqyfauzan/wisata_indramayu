<?= $this->extend('auth_user/layout_auth'); ?>

<?= $this->section('content'); ?>
<form class="login100-form" method="POST" action="<?= base_url() ?>/auth/login">
    <span class="login100-form-title p-b-43">
        Login
    </span>

    <?php if (session()->getFlashdata('success')) { ?>

        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>

    <?php } ?>

    <?php if (session()->getFlashdata('error')) { ?>

        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>

    <?php } ?>

    <div class="<?= ($validation->hasError('email')) ? 'wrap-input100-error' : 'wrap-input100' ?>">
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

    <div class="flex-sb-m w-full p-t-3 p-b-32">
        <div>
            <a href="/forgot_password" class="txt1">
                Forgot Password?
            </a>
        </div>
    </div>


    <div class="container-login100-form-btn mb-2">
        <button class="login100-form-btn">
            Login
        </button>
    </div>

    <div class="container-login100-form-btn mb-2">
        <a href="/registrasi" class="login100-form-btn-reg">
            Registrasi
        </a>
    </div>

    <div class="container-login100-form-btn">
        <a href="/" class="login100-form-btn-reg">
            Kembali ke halaman utama
        </a>
    </div>
</form>

<?= $this->endSection(); ?>