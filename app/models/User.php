<?php
class User {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function findByEmail($email){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email'=>$email]);
        return $stmt->fetch();
    }

    public function find($id){
        $stmt = $this->pdo->prepare("SELECT id,nama,email,role,created_at FROM users WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    public function create($nama, $email, $password, $role='penyewa'){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (nama,email,password,role) VALUES (:nama,:email,:password,:role)");
        return $stmt->execute(['nama'=>$nama,'email'=>$email,'password'=>$hash,'role'=>$role]);
    }

    public function all(){
        $stmt = $this->pdo->query("SELECT id,nama,email,role,created_at FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
