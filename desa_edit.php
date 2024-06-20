<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
    $id_desa = $_GET['id'];

    // Fetch existing data for the specified ID
    $sql_fetch = "SELECT id_desa, kecamatan, desa FROM master_desa WHERE id_desa=?";
    $stmt_fetch = mysqli_prepare($conn, $sql_fetch);
    mysqli_stmt_bind_param($stmt_fetch, "i", $id_desa);
    mysqli_stmt_execute($stmt_fetch);
    $result_fetch = mysqli_stmt_get_result($stmt_fetch);


    // Check if data exists for the specified ID
    if ($row = mysqli_fetch_assoc($result_fetch)) {
        // Assign data to $data array for use in the form
        $data = $row;

        // deskripsi halaman
        $pagedesc = "Edit desa";
        $menuparent = "master";
        include("layout_top.php");
?>

<!-- top of file -->

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data desa</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="desa_update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_desa" value="<?php echo $data['id_desa']; ?>">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Edit Data</h3>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nama Kecamatan</label>
                            <div class="col-sm-4">
                                <input type="text" name="kecamatan" class="form-control" placeholder="kecamatan"
                                    value="<?php echo $data['kecamatan'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nama desa</label>
                            <div class="col-sm-4">
                                <input type="text" name="desa" class="form-control" placeholder="desa"
                                    value="<?php echo $data['desa'] ?>" required>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <label class="control-label col-sm-3"></label>
                                <div class="col-sm-4 text-right">
                                    <button type="submit" name="perbarui" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.panel -->
                </form>

            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<!-- bottom of file -->
<?php
        include("layout_bottom.php");
    } else {
        // Handle the case where no data is found for the specified ID
        echo "Data dengan ID desa tersebut tidak ditemukan.";
    }
} else {
    // Tangani jika ID notaris tidak diberikan
    echo "ID desa tidak valid atau tidak diberikan.";
}

?>