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
        <h1 class="mb-4">Tambah Siswa</h1>

        <div>
            <form id="f1" method="POST">
                <div class="form-group mt-2">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukan nama_kelas">
                </div>
                <button type="submit" class="btn btn-success mt-2">Tambah</button>
            </form>
        </div>
    </div>

    <!-- DataTable Initialization Script -->
    <script>
        $(document).ready(function() {
            $("#f1").submit(function(e) {
                e.preventDefault();
                let nama = $("#nama_kelas").val();
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
                            url: "<?= $baseUrl ?>/kelas/store", // Replace with your server endpoint
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
                                    window.location.href = '<?= $baseUrl ?>/kelas/';
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