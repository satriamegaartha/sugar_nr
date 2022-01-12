<div id="colorlib-contact">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Login</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-6 col-md-push-1 animate-box">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('front/login'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        Login
                                    </button>
                                </form>
                                <div class="text-center">
                                    <a class="small" style="color: black;" href="<?= base_url('front/registration'); ?>">Registrasi Account!</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>