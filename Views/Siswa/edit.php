<?php
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS (for Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <!-- DataTables jQuery and JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container mt-5">
        <?php require_once 'helpers/UrlHelper.php'; ?>
        <h2>Edit Siswa</h2>
        <form action="<?= base_url('siswa/update') ?>" method="POST" id="f1">
            <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
            <div class="form-group mt-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $siswa['nama'] ?>">
            </div>
            <div class="form-group mt-2">
                <label>Kelas</label>
                <select name="kelas_id" id="kelas_id" class="form-control">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($classList as $value): ?>
                        <option value="<?= htmlspecialchars($value['id']) ?>"
                            <?= ($value['id'] == $siswa['kelas_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($value['nama_kelas']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="text" name="kelas" class="form-control" value="<?= $siswa['kelas'] ?>"> -->
            </div>
            <button type="submit" class="btn btn-success mt-2">Update</button>
        </form>

    </div>

    <!-- DataTable Initialization Script -->
    <script>
        $(document).ready(function() {
            $("#f1").submit(function(e) {
                e.preventDefault();
                let id = $("#id").val();
                let nama = $("#nama").val();
                let kelas_id = $("#kelas_id").val();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST", // Use POST method
                            url: "<?= $baseUrl ?>/siswa/update", // Replace with your server endpoint
                            data: $("#f1").serialize(), // Serialize the form data
                            success: function(response) {
                                // Handle server response here
                                // console.log(response); // Log the response from the server
                                // If the server returns success, you can show another message
                                Swal.fire({
                                    title: "Data Submitted!",
                                    text: "Your form data has been successfully submitted.",
                                    icon: "success"
                                });

                                setTimeout(() => {
                                    window.location.href = '<?= $baseUrl ?>/siswa/';
                                }, 3000);
                            },
                            error: function(error) {
                                // Handle errors here
                                console.error(error); // Log error for debugging
                                Swal.fire({
                                    title: "Error!",
                                    text: "There was an error submitting your data.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            })
        });
    </script>
</body>

</html>