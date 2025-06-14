<?php
require_once 'Config/Database.php';

class Kelas
{
    private $db;
    private $col;
    protected $fillables = [
        'id',
        'nama_kelas',
    ];
    protected $table = "kelas";
    public function __construct()
    {
        $this->db = getDatabaseConnection();
        $this->col = implode(',', $this->fillables);
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT $this->col FROM $this->table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT $this->col FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (nama_kelas) VALUES (:nama_kelas)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama_kelas' => $data['nama_kelas']
        ]);
    }
    public function update($id, $data)
    {
        $sql = "UPDATE $this->table SET nama_kelas = :nama_kelas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama_kelas' => $data['nama_kelas'],
            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
