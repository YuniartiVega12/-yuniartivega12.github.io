<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashdata('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">close</button>
    </div>
<?php
}
?>
<button class="btn btn-primary" data-toggle="modal" data-target="#addMenu">Tambah menu</button>
<table class="table table-stripped table-hover">
    <thead>
        <th>No</th>
        <th>nama</th>
        <th>jumlah</th>
        <th>keterangan</th>
        <th>jenis</th>
        <th>Harga</th>
        <th>option</th>
    </thead>

    <?php
    $no = 1;
    foreach ($data as $row) :
    ?>
        <tbody>
            <tr>
                <td><?= $no ?></<td>
                <td><?= $row['nama'] ?></<td>
                <td><?= $row['jumlah'] ?></<td>
                <td><?= $row['keterangan'] ?></<td>
                <td><?= $row['jenis'] ?></<td>
                <td><?= $row['harga'] ?></<td>
                <td>
                    <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#editMenu-<?= $row['id'] ?>">Edit</button>
                    <a href="<?= base_url('menu/delete/' . $row['id']) ?>" onclick="return confirm ('yakin mau hapus?')" class="btn btn-danger btn-sm btn-delete">Delete</a>
                </td>
            </tr>

        </tbody>
        <div class="modal fade" id="editMenu-<?= $row['id'] ?>" tanindex="-1" aria-labelledby="example" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example">Edit Menu</h5>
                        <button class="close" data-dismiss="modal" aria-label="close"></button>
                    </div>
                    <form action="<?= base_url('menu/edit/' . $row['id']) ?>" method="post">
                        <div clas="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="inputkan nama" value="<?= $row['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="inputkan jumlah" value="<?= $row['jumlah'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="inputkan keterangan" value="<?= $row['keterangan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jenis">Jenis </label>
                                <select name="jenis" id="jenis" class="form-control" value="<?= $row['jenis'] ?>">
                                    <option value="makanan">makanan</option>
                                    <option value="minuman">minuman</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="inputkan harga" value="<?= $row['harga'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
        $no++;
    endforeach;
    ?>

</table>
<div class="modal fade" id="addMenu" tanindex="-1" aria-labelledby="example" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 classs="modal-title" id="example">Tambah Menu</h5>
                <button class="close" data-dismiss="modal" aria-label="close"></button>
            </div>
            <form action="<?= base_url('menu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="inputkan nama">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="inputkan jumlah">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="inputkan keterangan">
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="makanan">makanan</option>
                            <option value="minuman">minuman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" id="harga" placeholder="inputkan harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>