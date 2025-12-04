<?php
require_once __DIR__ . '/../models/User.php';
class AuthController {
    private $pdo;
    private $userModel;
    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function showLogin(){
        include __DIR__ . '/../views/auth/login.php';
    }

    public function login(){
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $user = $this->userModel->findByEmail($email);
        if($user && password_verify($pass, $user['password'])){
          //  session_regenerate_id();
            $_SESSION['user'] = ['id'=>$user['id'],'nama'=>$user['nama'],'role'=>$user['role']];
            header('Location: index.php?action=catalog');
            exit;
        } else {
            $error = "Email atau password salah";
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    public function showRegister(){
        include __DIR__ . '/../views/auth/register.php';
    }

    public function register(){
        $nama = $_POST['nama'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        if($this->userModel->findByEmail($email)){
            $error = "Email sudah terdaftar";
            include __DIR__ . '/../views/auth/register.php';
            return;
        }
        $this->userModel->create($nama, $email, $pass, 'penyewa');
        header('Location: index.php?action=login&msg=registered');
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
