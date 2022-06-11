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
        <form role="form text-left" action="<?= site_url('user/new_inp') ?>" method="POST">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Nama Lengkap</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="name" required>
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
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">No Telepon</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="16" class="form-control" name="phone" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Tanggal Lahir</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" maxlength="255" class="form-control" name="birthdate" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Tempat Lahir</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="birthplace" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Username</h6>
            </label>
            <div class="col-sm-7">
              <input type="text" maxlength="255" class="form-control" name="username" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Password</h6>
            </label>
            <div class="col-sm-7">
              <input type="password" maxlength="255" class="form-control" name="password" required>
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