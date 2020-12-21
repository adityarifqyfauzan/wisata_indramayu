<?= $this->extend('auth_user/layout_auth') ?>

<?= $this->section('content') ?>
<form class="login100-form validate-form" method="POST" action="<?= base_url('auth/forgot_password') ?>">
    <span class="login100-form-title p-b-60 p-t-60">
        Lupa Password
    </span>
    <?= csrf_field() ?>

    <?php if (session()->getFlashdata('message')) { ?>

        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    
    <?php } ?>
    
    <?php if (session()->getFlashdata('success')) { ?>

        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
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

    <div class="container-login100-form-btn mb-2">
        <button class="login100-form-btn">
            Kirim email Reset Password
        </button>
    </div>

    <div class="col text-center mt-4">
        <a href="/login">Kembali Login</a>
    </div>

</form>
<?= $this->endSection() ?>