<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Input Koordinat";
$menuparent = "pertanahan";
include("layout_top.php");


if (isset($_POST['simpan'])) {
    $id_pengajuan = $_POST['id_pengajuan'];
    $koordinat_x = $_POST['koordinat_x'];
    $koordinat_y = $_POST['koordinat_y'];

    $sql_update = "UPDATE pengajuan SET koordinat_x='$koordinat_x', koordinat_y='$koordinat_y' WHERE id_pengajuan='$id_pengajuan'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Koordinat berhasil diperbarui.');</script>";
        echo "<script>window.location.href = 'app.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui koordinat.');</script>";
    }
}

$id_pengajuan = $_GET['no'];
$Sql = "SELECT * FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
$Qry = mysqli_query($conn, $Sql);
$data = mysqli_fetch_array($Qry);
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Input Koordinat X dan Y</h1>
            </div>

            <div class="row">
                <div class="col-lg-8"><?php include("layout_alert.php"); ?></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <form class="form-horizontal" name="input_koordinat" action="kode_qr.php" method="POST">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Form Input Koordinat</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">ID Pengajuan</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="id_pengajuan" class="form-control"
                                            value="<?php echo $data['id_pengajuan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Koordinat X</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="koordinat_x" class="form-control input-sm"
                                            placeholder="Masukkan Koordinat X" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Koordinat Y</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="koordinat_y" class="form-control input-sm"
                                            placeholder="Masukkan Koordinat Y" required>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-3">
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
</script>
<?php
include("layout_bottom.php");
?>