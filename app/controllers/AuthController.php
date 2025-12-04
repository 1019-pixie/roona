<?php
use Firebase\JWT\JWT;
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
            

            $payload = [
                'iss' => 'roona-app', // Penerbit
                'iat' => time(),      // Waktu dibuat
                'exp' => time() + (60 * 60 * 24), // Kadaluarsa (24 jam)
                'data' => [
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ]
            ];


            $key = $_ENV['JWT_SECRET'] ?? 'default_secret';
            $jwt = JWT::encode($payload, $key, 'HS256');


            setcookie('X-ROONA-SESSION', $jwt, time() + (60 * 60 * 24), "/", "", false, true);
            

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
        
        setcookie('X-ROONA-SESSION', '', time() - 3600, "/");
        
        header('Location: index.php?action=login');
    }
}
