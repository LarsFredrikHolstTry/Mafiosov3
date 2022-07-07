<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$ACC_row =  DB::run("SELECT ACC_mail, ACC_password FROM account WHERE ACC_id = ?", [$session_id])->fetch();

?>
<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->settings; ?></h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">E-post</label>
                    <div class="col">
                        <input type="email" class="form-control" value="<?= $ACC_row['ACC_mail'] ?>">
                        <small class="form-hint">Vi deler aldri e-posten med noen andre</small>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Passord</label>
                    <div class="col">
                        <input type="password" class="form-control" value="<?= 'password' ?>">
                        <small class="form-hint">
                            Passordet må være over 7 karakterer langt
                        </small>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Lagre</button>
                </div>
            </form>
        </div>
    </div>
</div>