<?php
require_once 'Model/Siswa.php';
require_once 'Model/Kelas.php';
require_once 'Helpers/JsonResponse.php';

class SiswaController
{
    public function index()
    {
        include 'Views/Siswa/index.php';
    }
    public function create()
    {
        $kelas = new Kelas();
        $classList = $kelas->getAll();
        include 'Views/Siswa/create.php';
    }
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID tidak ditemukan.";
            return;
        }

        // Misalnya pakai model SiswaModel
        $model = new Siswa();
        $siswa = $model->find($id);

        if (!$siswa) {
            echo "Data siswa tidak ditemukan.";
            return;
        }
        $kelas = new Kelas();
        $classList = $kelas->getAll();
        include 'Views/Siswa/edit.php';
    }

    public function data()
    {
        $siswa = new Siswa();
        $data = $siswa->getAll();
        responseJson($data, 'Data siswa berhasil diambil');
    }

    public function store()
    {
        $siswa = new Siswa();
        $siswa->insert($_POST);
        responseJson([], 'Berhasil Ditambahkan');
    }
    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'nama' => $_POST['nama'],
            'kelas_id' => $_POST['kelas_id']
        ];

        $model = new Siswa();
        $model->update($id, $data);

        responseJson([], 'Sukses');
    }
    public function delete()
    {
        $id = $_GET['id'];
        $model = new Siswa();
        $model->delete($id);
        responseJson([], 'Deleted');
    }

    // edit, update, delete bisa ditambahkan juga
}
