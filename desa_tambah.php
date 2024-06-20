<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "desa Tambah";
$menuparent = "master";
include("layout_top.php");
$sql_kecamatan = "SELECT DISTINCT kecamatan FROM master_desa"; // Mengambil daftar kecamatan yang unik dari tabel master_desa
$result_kecamatan = $conn->query($sql_kecamatan);

$kecamatanArray = []; // Array untuk menyimpan nama-nama kecamatan
if ($result_kecamatan->num_rows > 0) {
    // Menyimpan nama-nama kecamatan ke dalam array
    while ($row_kecamatan = $result_kecamatan->fetch_assoc()) {
        $kecamatanArray[] = $row_kecamatan['kecamatan'];
    }
}

?>
<script type="text/javascript">
function checkNppAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        data: 'id_desa=' + $("#master_desa").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}

function autoFillIdONotaris() {
    // Logika untuk memberikan nilai otomatis ke id_desa
}

function checkidopdAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        data: 'id_desa=' + $("#id_desa").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}

function autoFillIdDesa() {
    getDesaByTahun();
}

function getDesaByTahun() {
    var selectedTahun = $("select[name='kecamatan']").val();

    $("#loaderIcon").show();
    jQuery.ajax({
        data: 'tahun=' + selectedTahun,
        type: "POST",
        url: "master_desa.php", // Ganti ini dengan nama file PHP Anda
        success: function(data) {
            $("#daftardesa").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
</script>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data desa</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="desa_insert.php" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Nama desa</h3>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kecamatan</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php
									foreach ($kecamatanArray as $kecamatan) {
                                        echo "<option value='" . $kecamatan . "'>" . $kecamatan . "</option>";
                                    }
									?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Desa</label>
                            <div class="col-sm-4">
                                <input type="text" name="desa" class="form-control" placeholder="Desa" required>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="form-group">
                                <label class="control-label col-sm-3"></label>
                                <div class="col-sm-4 text-right">
                                    <button type="submit" name="simpan" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><!-- /.panel -->
            </form>
        </div>
    </div>
</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<script>
$(document).ready(function() {
    autoFillIddesa();
});
</script>


<?php
include("layout_bottom.php");
?>