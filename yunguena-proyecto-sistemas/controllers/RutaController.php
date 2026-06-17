<?php
// controllers/RutaController.php

require_once __DIR__ . '/../models/RutaModel.php';

class RutaController {
    private RutaModel $model;

    public function __construct() {
        $this->model = new RutaModel();
    }

    /** GET index.php?page=rutas */
    public function index(): array {
        return [
            'viajes'   => $this->model->getViajesDisponibles(),
            'ciudades' => $this->model->getCiudades(),
        ];
    }

    /** GET index.php?page=rutas&buscar=1&origen=X&destino=Y&fecha=Z */
    public function buscar(): array {
        $origen  = trim($_GET['origen']  ?? '');
        $destino = trim($_GET['destino'] ?? '');
        $fecha   = trim($_GET['fecha']   ?? '');

        return [
            'viajes'   => $this->model->getViajesDisponibles($origen, $destino, $fecha),
            'ciudades' => $this->model->getCiudades(),
            'filtros'  => compact('origen', 'destino', 'fecha'),
        ];
    }

    /** GET index.php?page=detalle_viaje&viaje_id=X */
    public function detalleViaje(int $viajeId): array {
        $viaje = $this->model->getViajeById($viajeId);
        if (!$viaje) {
            header('Location: index.php?page=rutas');
            exit;
        }
        $asientosOcupados = $this->model->getAsientosOcupados($viajeId);
        $asientos         = $this->model->getAsientosBus($viaje['bus_id']);

        return compact('viaje', 'asientos', 'asientosOcupados');
    }
}