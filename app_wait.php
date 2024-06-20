<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Approve";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;
setlocale(LC_TIME, 'id_ID');
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Permohonan Masuk</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="app_wait.php" method="GET">
                    <div class="col-lg-2" style="margin-top: 20px; margin-bottom: 10px;">
                        <label for="selectYear">Pilih Tahun:</label>
                        <select class="form-control" id="selectYear" name="selectYear" required>
                            <option value="">Pilih Tahun Acara</option>
                            <?php
                            $start_year = 2024;
                            $end_year = date('Y');
                            $getYear = (isset($_GET['selectYear']) && is_numeric($_GET['selectYear'])) ? $_GET['selectYear'] : '';
                            for ($year = $start_year; $year <= $end_year; $year++) {
                                $selected = ($year == $getYear) ? 'selected="selected"' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px; margin-bottom: 5px;">
                        <br>
                        <button type="button" class="btn btn-primary" onclick="exportDataMasuk()"
                            id="exportButton">Export</button>
                        <br>
                        <a href="" id="download-link" style="display: none;"></a>
                    </div>
                </form>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                        // Query
                        $sql = "SELECT pengajuan.*, master_notaris.nama_notaris FROM pengajuan INNER JOIN master_notaris ON pengajuan.id_notaris = master_notaris.id_notaris WHERE pengajuan.status_pengajuan = 'Awaiting' ORDER BY id_pengajuan DESC";
                        $Qry = mysqli_query($conn, $sql);

                        // Periksa apakah query berhasil dieksekusi
                        if ($Qry) {
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="tabel-data">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">No KTP</th>
                                    <th width="15%">Nama</th>
                                    <th width="15%">Pekerjaan</th>
                                    <th width="10%">Nama Notaris</th>
                                    <th width="10%">Alamat Rumah</th>
                                    <th width="10%">Scan Sertipikat</th>
                                    <th width="10%">Screenshot Google Map</th>
                                    <th width="10%">Lokasi Tanah</th>
                                    <th width="10%">Koordinat X</th>
                                    <th width="10%">Koordinat Y</th>
                                    <th width="10%">No HAK</th>
                                    <th width="10%">No SU</th>
                                    <th width="10%">NIB</th>
                                    <th width="10%">Luas Tanah(m2)</th>
                                    <th width="10%">Penggunaan</th>
                                    <th width="10%">Tanggal Pengajuan</th>
                                    <th width="20%">Status Pengajuan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$i = 1;
									while ($data = mysqli_fetch_assoc($Qry)) {
										switch ($data['status_pengajuan']) {
											case 'Awaiting':
												$label = 'label label-warning label-outlined';
												break;
											case 'Approved':
												$label = 'label label-success label-outlined';
												break;
											case 'Declined':
												$label = 'label label-danger label-outlined';
												break;
											default:
												$label = 'label label-info label-outlined';
												break;
										}
										echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
											echo '<td class="text-center">' . $data['no_ktp'] . '</td>';
											echo '<td class="text-center">' . $data['nama'] . '</td>';
											echo '<td class="text-center">' . $data['pekerjaan'] . '</td>';
											echo '<td class="text-center">' . $data['nama_notaris'] . '</td>';
											echo '<td class="text-center">' . $data['alamat_rumah'] . '</td>';
                                            echo '<td class="text-center"><a href="javascript:void(1);" onclick="viewPDF(\'scan/' . basename($data['scan']) . '\', this);" data-file="' . basename($data['scan']) . '">Lihat Scan</a></td>';
                                            echo '<td class="text-center"><a href="javascript:void(0);" onclick="viewSS(\'ss_gmap/' . basename($data['ss_gmap']) . '\', this);" data-file="' . basename($data['ss_gmap']) . '">Lihat SS Google Map</a></td>';
                                            echo '<td class="text-center"><a href="javascript:void(2);" onclick="viewQr(' . $data['id_pengajuan'] . ')" id="viewqr">Lihat Lokasi Tanah</a></td>';
                                            echo '<td class="text-center">' . $data['koordinat_x'] . '</td>';
                                            echo '<td class="text-center">' . $data['koordinat_y'] . '</td>';
											echo '<td class="text-center">' . $data['no_hak'] . '</td>';
											echo '<td class="text-center">' . $data['no_su'] . '</td>';
											echo '<td class="text-center">' . $data['nib'] . '</td>';
											echo '<td class="text-center">' . $data['luas'] . '</td>';
											echo '<td class="text-center">' . $data['penggunaan'] . '</td>';
											echo '<td class="text-center">' . strftime('%d %B %Y %H:%M:%S', strtotime($data['tanggal_pengajuan'])) . '</td>';
											echo '<td class="text-center">' . '<div class="label label-warning label-outlined">' . $data['status_pengajuan'] . '</div>';

											if ($data['status_pengajuan'] == 'Awaiting') {
												echo '<div style="margin-top: 5px">';
												echo '<a href="approval_review.php?no=' . $data['id_pengajuan'] . '"><button class="btn btn-primary btn-xs">Review</button></a>';
												echo '</div>';
											}
											echo '</td>';
											echo '<td class="text-center">';
											echo '<div style="margin-top: 5px">';
											echo '<button class="btn btn-danger btn-xs" onclick="hapusData(' . $data['id_pengajuan'] . ')">Hapus</button>';
											echo '</div>';
											echo '</td>';
										echo '</tr>';
										$i++;
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
                        <!-- Modal untuk menampilkan scan -->
                        <div class="modal fade" id="myModalScan" tabindex="-1" role="dialog"
                            aria-labelledby="pdfModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="pdfModalLabel">Scan</h4>
                                    </div>
                                    <div class="modal-body" id="embed-wrapper">
                                        <!--<object data="" type="application/pdf" width="100%" height="768px">-->
                                        <!--    <embed src="" width="100%" height="768px">-->
                                        <!--</object>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</script>
<script>
function downloadFile(fileUrl) {
    var baseUrl = ''; // Definisikan baseUrl jika diperlukan
    var finalUrl = baseUrl + fileUrl; // Buat URL final
    window.location.href = finalUrl;
}

function viewQr(id_pengajuan) {
    $.ajax({
        url: 'generate_qr.php',
        type: 'POST',
        data: {
            id_pengajuan: id_pengajuan
        },
        success: function(response) {
            console.log(response);
            if (response) {
                var url = response;
                window.open(url, '_blank');
            } else {
                alert(
                    'Error: Could not generate the file. Please check the provided information and try again.'
                );
            }
        },
        error: function(error) {
            console.error('Error Generating QR Code:', error);
            alert('Error: Could not communicate with the server. Please try again later.');
        }
    });
}

function viewSS(fileUrl, e) {
    var datasetFile = $(e).data('file');
    var finalUrl = 'ss_gmap/' + datasetFile.replace(/\s/g, '%20');
    window.open(finalUrl, '_blank'); // '_blank' untuk membuka tautan dalam tab baru
}



function viewPDF(pdfUrl, e) {
    var viewerUrl = 'scan/';
    var viewerUrlWithPDF = viewerUrl + pdfUrl;
    var datasetFile = $(e)[0].dataset.file;
    var baseUrl = 'scan/';
    var finalUrl = baseUrl + datasetFile.replace(/\s/g, '%20') + '#navpanes=0';

    $('#embed-wrapper').html('');
    $('#embed-wrapper').html(`
            <object data="` + finalUrl + `" type="application/pdf" width="100%" height="768px">
                <embed src="` + finalUrl + `" width="100%" height="768px">
            </object>`);
    $('#myModalScan').modal('show');
}

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

function exportDataMasuk() {
    var selectedYear = $('#selectYear').val();
    if (selectedYear !== '') {
        $.ajax({
            url: 'export_data_masuk.php',
            type: 'POST',
            data: {
                selectYear: selectedYear
            },
            success: function(response) {
                if (response) {
                    var url = response;
                    window.location = url;
                } else {
                    alert(
                        'Error: Could not generate the file. Please check the provided information and try again.'
                    );
                }
            },
            error: function(error) { // Pindahkan error handler ke luar dari success
                console.error('Error exporting data:', error);
            }
        });
    } else {
        alert('Pilih tahun terlebih dahulu.');
    }
}
</script>


<script>
$(document).ready(function() {
    // Iterasi setiap baris tabel
    $('#tabel-data tbody tr').each(function() {
        var statusPengajuan = $(this).find('td:eq(8)').text();

        // Tambahkan logika sesuai kebutuhan
        if (statusPengajuan === 'Awaiting') {
            $(this).css('background-color', 'white');
        }
    });
});
</script>


<?php
include("layout_bottom.php");
?>