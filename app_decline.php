<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Declined";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;
setlocale(LC_TIME, 'id_ID');
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Permohonan Ditolak</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
						// Query
						$sql = "SELECT pengajuan.*, master_notaris.nama_notaris,master_desa.desa FROM pengajuan INNER JOIN master_notaris ON pengajuan.id_notaris = master_notaris.id_notaris INNER JOIN master_desa ON pengajuan.id_desa = master_desa.id_desa WHERE pengajuan.status_pengajuan = 'Declined' ORDER BY id_pengajuan DESC";
						$Qry = mysqli_query($conn, $sql);
						// Periksa apakah query berhasil dieksekusi
						if ($Qry) {
						?>
                        <table class="table table-striped table-bordered table-hover" id="tabel-data">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">ID Pengajuan</th>
                                    <th width="10%">No KTP</th>
                                    <th width="15%">Nama</th>
                                    <th width="15%">Pekerjaan</th>
                                    <th width="10%">Nama Notaris</th>
                                    <th width="10%">Alamat Rumah</th>
                                    <th width="10%">Koordinat X</th>
                                    <th width="10%">Koordinat Y</th>
                                    <th width="10%">No HAK</th>
                                    <th width="10%">No SU</th>
                                    <th width="10%">NIB</th>
                                    <th width="10%">Luas Tanah(m2)</th>
                                    <th width="10%">Penggunaan</th>
                                    <th width="10%">Tanggal Pengajuan</th>
                                    <th width="20%">Alasan Ditolak</th>
                                    <th width="20%">Status Pengajuan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$i = 1;
									while ($data = mysqli_fetch_assoc($Qry)) {
										if ($data['status_pengajuan'] != 'Approved' && $data['status_pengajuan'] != 'Awaiting') {

											echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
                                            echo '<td class="text-center">' . $data['id_pengajuan'] . '</td>';
                                            echo '<td class="text-center">' . $data['no_ktp'] . '</td>';
                                            echo '<td class="text-center">' . $data['nama'] . '</td>';
                                            echo '<td class="text-center">' . $data['pekerjaan'] . '</td>';
                                            echo '<td class="text-center">' . $data['nama_notaris'] . '</td>';
                                            echo '<td class="text-center">' . $data['alamat_rumah'] . '</td>';
                                            echo '<td class="text-center">' . $data['koordinat_x'] . '</td>';
											echo '<td class="text-center">' . $data['koordinat_y'] . '</td>';
                                            echo '<td class="text-center">' . $data['no_hak'] . '</td>';
                                            echo '<td class="text-center">' . $data['no_su'] . '</td>';
                                            echo '<td class="text-center">' . $data['nib'] . '</td>';
                                            echo '<td class="text-center">' . $data['luas'] . '</td>';
                                            echo '<td class="text-center">' . $data['penggunaan'] . '</td>';
                                            echo '<td class="text-center">' . strftime('%d %B %Y %H:%M:%S', strtotime($data['tanggal_pengajuan'])) . '</td>';
                                            echo '<td class="text-center">' . $data['keterangan_decline'] . '</td>';
                                            echo '<td class="text-center">' . '<div class="label label-warning label-outlined">' . $data['status_pengajuan'] . '</div>';
											echo '</td>';
											echo '<td class="text-center">';
											echo '<button class="btn btn-danger btn-xs" onclick="hapusData(' . $data['id_pengajuan'] . ')">Hapus</button>';
											echo '</td>';
											echo '</tr>';
											$i++;
										}
									}
									?>
                            </tbody>
                        </table>
                        <?php
						} else {
							// Tambahkan penanganan kesalahan sesuai kebutuhan
							echo "Query failed: " . mysqli_error($conn);
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#tabel-data').DataTable({
        "responsive": true,
        "processing": true,
        "columnDefs": [{
            "orderable": false,
            "targets": []
        }]
    });

    $('#tabel-data').parent().addClass("table-responsive");
});

var app = {
    code: '0'
};

function hapusData(id_pengajuan) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        $.ajax({
            url: 'hapus_data.php',
            type: 'POST',
            data: {
                id_pengajuan: id_pengajuan
            },
            success: function(response) {
                console.log('Data berhasil dihapus:', response);
                window.location.reload();
            },
            error: function(error) {
                console.error('Error saat menghapus data:', error);
                alert('Gagal menghapus data. Silakan coba lagi.');
            }
        });
    }
}
</script>
<script>
$('[data-load-code]').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var code = $this.data('load-code');
    if (code) {
        $($this.data('remote-target')).load('surat_detail.php?code=' + code);
        app.code = code;
    }
});
</script>

<?php
include("layout_bottom.php");
?>