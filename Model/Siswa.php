<?php
require_once 'Config/Database.php';

class Siswa
{
    private $db;

    protected $fillables = [
        'id',
        'nama',
        'kelas_id'
    ];
    //Logic 
    public function __construct()
    {
        $this->db = getDatabaseConnection();
    }

    private function getAliasedColumns($alias)
    {
        return implode(', ', array_map(fn($col) => "$alias.$col", $this->fillables));
    }

    public function getAll()
    {
        $column = $this->getAliasedColumns('s');
        $sql = "SELECT $column, k.nama_kelas 
        FROM siswa AS s 
        JOIN kelas AS k ON s.kelas_id = k.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $column = $this->getAliasedColumns('s');
        $sql = "SELECT $column, k.nama_kelas 
        FROM siswa AS s 
        JOIN kelas AS k ON s.kelas_id = k.id WHERE s.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO siswa (nama, kelas_id) VALUES (?, ?)");
        return $stmt->execute([$data['nama'], $data['kelas_id']]);
    }
    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE siswa SET nama = ?, kelas_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['nama'],
            $data['kelas_id'],
            $id
        ]);
    }
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM siswa WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
