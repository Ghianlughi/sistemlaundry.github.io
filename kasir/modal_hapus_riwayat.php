<div class="me-1 mb-1 d-inline-block">
    <!-- Button trigger for default modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#defaultSize<?= $transaksi['id'] ?>">
        Hapus
    </button>

    <!--Default size Modal -->
    <div class="modal fade text-left" id="defaultSize<?= $transaksi['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">Hapus Data Transaksi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Yakin Ingin Menghapus Data Transaksi ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tidak</span>
                    </button>
                    <form method="post">
                        <input type="text" class="visually-hidden" value="<?= $transaksi['id']; ?>" name="idhapus">
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="hps">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Ya</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>