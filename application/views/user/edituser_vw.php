<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form role="form text-left" action="<?= site_url('user/edit_inp') ?>" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Nama Lengkap</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="name" required value="<?= $user['complete_name'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Posisi</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control" required name="pos">
                <option value="">-- Pilih --</option>
                <?php foreach ($pos as $key => $value) { ?>
                  <option <?= $value == $user['position'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">No Telepon</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="16" class="form-control" name="phone" required value="<?= $user['phone'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Tanggal Lahir</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" maxlength="255" class="form-control" name="birthdate" required value="<?= substr($user['birthdate'], 0, 10) ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Tempat Lahir</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="birthplace" required value="<?= $user['birth'] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Username</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="username" required value="<?= $user['username'] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Password</h6>
            </label>
            <div class="col-sm-7">
              <input type="password" maxlength="255" class="form-control" name="password" value="">
            </div>
          </div>

          <div class="text-center">
            <br>
            <button type="submit" class="btn bg-gradient-dark">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>