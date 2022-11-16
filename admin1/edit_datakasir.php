<a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#normal<?= $data['id']; ?>">
    <i></i>
    <span>Edit</span>
</a>
<div class="modal fade text-left" id="normal<?= $data['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Edit Member</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <input type="text" class="visually-hidden" value="<?=$data['id'] ?>" name="idd">
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" placeholder="Nama" name="namak" value="<?= $data['nama']; ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                        <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" placeholder="user" name="userk" value="<?= $data['username']; ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-bookmark"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" placeholder="pass" name="pask" value="<?= $data['password']; ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        </div>
                    <div class="col-sm">
                        <label>Masukkan Role</label>
                        <fieldset class="form-group">
                        <select class="form-select" id="basicSelect" name="editrole" value="<?= $data['role']; ?>">
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="dsimpan">
                            <input type="text" class="visually-hidden" value="<?= $data['id']; ?>" name="id">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $data['id']; ?>">
    <i></i>
    <span>Delete</span>
</a>
<div class="modal fade text-left" id="hapus<?= $data['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Hapus</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <h5 class="text-center">Apakah Anda yakin ingin menghapus member?</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tidak</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="delete">
                            <input type="text" class="visually-hidden" value="<?= $data['id']; ?>" name="idhapus">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Ya</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>