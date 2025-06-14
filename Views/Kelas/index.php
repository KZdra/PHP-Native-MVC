<?php
require_once 'Helpers/UrlHelper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS (for Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <!-- DataTables jQuery and JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Kelas</h1>
        <a href="<?= base_url()?>/kelas/create" class="btn btn-success mb-2">Tambah kelas</a>
        <!-- Table with Bootstrap styling -->
        <table id="kelasTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by DataTables -->
            </tbody>
        </table>
    </div>

    <!-- DataTable Initialization Script -->
    <?php require_once 'helpers/UrlHelper.php'; ?>
<script>
$(document).ready(function () {
    $('#kelasTable').DataTable({
        ajax: '<?= base_url("kelas/data") ?>',
        columns: [
            { data: 'nama_kelas' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <a href="<?= base_url("kelas/edit?id=") ?>${row.id}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick="hapusKelas(${row.id})">Hapus</button>
                    `;
                }
            }
        ]
    });
});

// Fungsi hapus
function hapusKelas(id) {
    Swal.fire({
        title: 'Yakin hapus data?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url("kelas/delete?id=") ?>' + id,
                method: 'POST',
                success: function (res) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                    $('#kelasTable').DataTable().ajax.reload();
                },
                error: function () {
                    Swal.fire('Gagal!', 'Tidak dapat menghapus data.', 'error');
                }
            });
        }
    });
}
</script>

</body>

</html>