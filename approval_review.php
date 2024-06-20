<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Approval";
$menuparent = "pertanahan";
include("layout_top.php");
$now = date('Y-m-d');
$id_pengajuan = $_GET['no'];
$Sql = "SELECT pengajuan.*, master_notaris.nama_notaris, master_desa.desa FROM pengajuan INNER JOIN master_notaris ON pengajuan.id_notaris = master_notaris.id_notaris INNER JOIN master_desa ON pengajuan.id_desa = master_desa.id_desa WHERE id_pengajuan = " . $id_pengajuan;
$Qry = mysqli_query($conn, $Sql);
$sql_petugas = "SELECT id_petugas, nama_petugas FROM master_petugas";
$result_petugas = $conn->query($sql_petugas);
$data = mysqli_fetch_array($Qry);
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Permohonan</h1>
            </div>

            <div class="row">
                <div class="col-lg-8"><?php include("layout_alert.php"); ?></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <form class="form-horizontal" name="aproval_review" action="approval_update.php" method="POST"
                        enctype="multipart/form-data" onSubmit="return valid();">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Review</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">ID Pengajuan</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no" class="form-control"
                                            value="<?php echo $data['id_pengajuan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class=" form-group">
                                    <label class="control-label col-sm-3">Nomor KTP</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_ktp" class="form-control"
                                            value="<?php echo $data['no_ktp']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nama</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nama" class="form-control"
                                            value="<?php echo $data['nama']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="tanggal_lahir" class="form-control"
                                            value="<?php echo $data['tanggal_lahir']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Umur</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="umur" class="form-control"
                                            value="<?php echo $data['umur']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Pekerjaan</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="pekerjaan" class="form-control"
                                            value="<?php echo $data['pekerjaan']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Email</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="email" class="form-control"
                                            value="<?php echo $data['email']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nama Notaris</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nama_notaris" class="form-control"
                                            value="<?php echo $data['nama_notaris']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Selaku</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="selaku" class="form-control"
                                            value="<?php echo $data['selaku']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Kecamatan</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="kecamatan" class="form-control"
                                            value="<?php echo $data['kecamatan']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Desa</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="desa" class="form-control"
                                            value="<?php echo $data['desa']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Alamat Rumah</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="alamat_rumah" class="form-control"
                                            value="<?php echo $data['alamat_rumah']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nomor HP</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_hp" class="form-control"
                                            value="<?php echo $data['no_hp']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Lokasi Tanah</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="lokasi_tanah" class="form-control"
                                            value="<?php echo $data['lokasi_tanah']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Koordinat X</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="koordinat_x" class="form-control"
                                            value="<?php echo $data['koordinat_x']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Koordinat Y</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="koordinat_y" class="form-control"
                                            value="<?php echo $data['koordinat_y']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Jenis Hak</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="jenis_hak" class="form-control"
                                            value="<?php echo $data['jenis_hak']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nomor HAK</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_hak" class="form-control"
                                            value="<?php echo $data['no_hak']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nomor SU</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_su" class="form-control"
                                            value="<?php echo $data['no_su']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">NIB</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nib" class="form-control"
                                            value="<?php echo $data['nib']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Luas Tanah (m2)</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="luas" class="form-control"
                                            value="<?php echo $data['luas']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Penggunaan</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="penggunaan" class="form-control"
                                            value="<?php echo $data['penggunaan']; ?> " readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Aksi</label>
                                    <div class="col-sm-4">
                                        <select name="aksi" id="aksi" class="form-control" required>
                                            <option value="" selected>---- Pilih Aksi ----</option>
                                            <option value="1">Diterima</option>
                                            <option value="2">Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="keterangan_decline" style="display: none;">
                                    <label class="control-label col-sm-3">Keterangan Decline</label>
                                    <div class="col-sm-4">
                                        <textarea name="keterangan_decline" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" id="petugas_pemetaan" style="display: none;">
                                    <label class="control-label col-sm-3">Petugas Pemetaan</label>
                                    <div class="col-sm-4">
                                        <select name="petugas_pemetaan" id="petugas_pemetaan" class="form-control"
                                            required>
                                            <option value="" disabled selected>Pilih Petugas Pemetaan</option>
                                            <?php
                                            while ($row_petugas = $result_petugas->fetch_assoc()) {
                                                echo "<option value='" . $row_petugas['nama_petugas'] . "'>" . $row_petugas['nama_petugas'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group">
                                    <label class="control-label col-sm-3"></label>
                                    <div class="col-sm-4 text-right">
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $('#aksi').change(function() {
        if ($(this).val() === '2') {
            $('#keterangan_decline').show(); // Tampilkan field Keterangan Decline
        } else {
            $('#keterangan_decline').hide(); // Sembunyikan field Keterangan Decline
        }
    });
});
$(document).ready(function() {
    $('#aksi').change(function() {
        if ($(this).val() === '1') {
            $('#petugas_pemetaan').show(); // Tampilkan field Keterangan Decline
        } else {
            $('#petugas_pemetaan').hide(); // Sembunyikan field Keterangan Decline
        }
    });
});
</script>

<?php
include("layout_bottom.php");
?>