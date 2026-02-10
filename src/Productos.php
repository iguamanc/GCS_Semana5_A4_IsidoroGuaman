<?php

class Productos
{
    private $productos = [];

    public function __construct()
    {
        // Simulación de almacenamiento en memoria
        $this->productos = [
            ["id" => 1, "nombre" => "Laptop", "precio" => 800],
            ["id" => 2, "nombre" => "Mouse", "precio" => 20],
        ];
    }

    public function manejarRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $this->listar();
        } elseif ($method === 'POST') {
            $this->agregar();
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
        }
    }

    private function listar()
    {
        header('Content-Type: application/json');
        echo json_encode($this->productos);
    }

    private function agregar()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nombre']) && isset($input['precio'])) {
            $nuevo = [
                "id" => count($this->productos) + 1,
                "nombre" => $input['nombre'],
                "precio" => $input['precio']
            ];

            $this->productos[] = $nuevo;

            header('Content-Type: application/json');
            echo json_encode([
                "mensaje" => "Producto agregado correctamente",
                "producto" => $nuevo
            ]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }
}
