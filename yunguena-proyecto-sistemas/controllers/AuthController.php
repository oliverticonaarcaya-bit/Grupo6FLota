<?php
// controllers/AuthController.php

require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController {
    private UsuarioModel $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new UsuarioModel();
    }

    /** POST /auth/login */
    public function login(): void {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$email || !$password) {
            $this->redirectWithError('login', 'Completa todos los campos.');
            return;
        }

        $usuario = $this->model->findByEmail($email);

        if (!$usuario || !$this->model->verifyPassword($password, $usuario['password'])) {
            $this->redirectWithError('login', 'Correo o contraseña incorrectos.');
            return;
        }

        // Crear sesión
        $_SESSION['user_id']    = $usuario['id'];
        $_SESSION['user_nombre'] = $usuario['nombre'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_rol']   = $usuario['rol'];

        // Redirigir a donde intentaba ir
        $redirect = $_SESSION['redirect_after_login'] ?? 'index.php?page=rutas';
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect");
        exit;
    }

    /** POST /auth/register */
    public function register(): void {
        $data = [
            'nombre'   => trim($_POST['nombre']   ?? ''),
            'apellido' => trim($_POST['apellido'] ?? ''),
            'email'    => trim($_POST['email']    ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'ci'       => trim($_POST['ci']       ?? ''),
        ];

        foreach (['nombre','apellido','email','password'] as $f) {
            if (!$data[$f]) {
                $this->redirectWithError('register', 'Completa los campos obligatorios.');
                return;
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirectWithError('register', 'Correo inválido.');
            return;
        }

        if (strlen($data['password']) < 6) {
            $this->redirectWithError('register', 'La contraseña debe tener al menos 6 caracteres.');
            return;
        }

        if ($this->model->emailExists($data['email'])) {
            $this->redirectWithError('register', 'Ese correo ya está registrado.');
            return;
        }

        $id = $this->model->create($data);
        $_SESSION['user_id']     = $id;
        $_SESSION['user_nombre'] = $data['nombre'];
        $_SESSION['user_email']  = $data['email'];
        $_SESSION['user_rol']    = 'cliente';

        header('Location: index.php?page=rutas&success=registered');
        exit;
    }

    /** GET /auth/logout */
    public function logout(): void {
        session_destroy();
        header('Location: index.php?page=home');
        exit;
    }

    // ── helpers ──────────────────────────────
    private function redirectWithError(string $page, string $msg): void {
        $_SESSION['auth_error'] = $msg;
        header("Location: index.php?page=$page");
        exit;
    }
}