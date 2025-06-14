<?php
require_once 'Model/Kelas.php';
require_once 'Helpers/JsonResponse.php';

class KelasController
{
    public function index()
    {
        include 'Views/Kelas/index.php';
    }
    public function create()
    {
        include 'Views/Kelas/create.php';
    }
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID tidak ditemukan.";
            return;
        }

        // Misalnya pakai model SiswaModel
        $model = new Kelas();
        $kelas = $model->find($id);

        if (!$kelas) {
            echo "Data kelas tidak ditemukan.";
            return;
        }

        include 'Views/Kelas/edit.php';
    }

    public function data()
    {
        $kelas = new Kelas();
        $data = $kelas->getAll();
        responseJson($data, 'Data kelas berhasil diambil');
    }

    public function store()
    {
        $kelas = new Kelas();
        $kelas->insert($_POST);
        responseJson([], 'Berhasil Ditambahkan');
    }
    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'nama_kelas' => $_POST['nama_kelas']
        ];

        $model = new Kelas();
        $model->update($id, $data);

        responseJson([], 'Sukses');
    }
    public function delete()
    {
        $id = $_GET['id'];
        $model = new Kelas();
        $model->delete($id);
        responseJson([], 'Deleted');
    }

    // edit, update, delete bisa ditambahkan juga
}
