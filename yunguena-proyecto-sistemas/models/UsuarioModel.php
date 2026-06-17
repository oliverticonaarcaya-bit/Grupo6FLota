<?php
// models/UsuarioModel.php

require_once __DIR__ . '/../config/database.php';

class UsuarioModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /** Buscar usuario por email */
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare(
            'SELECT * FROM usuarios WHERE email = ? AND activo = 1 LIMIT 1'
        );
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Buscar usuario por ID */
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare(
            'SELECT id, nombre, apellido, email, telefono, ci, rol FROM usuarios WHERE id = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Crear nuevo usuario */
    public function create(array $data): int {
        $stmt = $this->db->prepare(
            'INSERT INTO usuarios (nombre, apellido, email, password, telefono, ci)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['telefono'] ?? null,
            $data['ci']       ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    /** Verificar contraseña */
    public function verifyPassword(string $plain, string $hash): bool {
        return password_verify($plain, $hash);
    }

    /** Email ya registrado */
    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return (bool) $stmt->fetch();
    }
}