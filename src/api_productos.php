<?php
// Simulación de almacenamiento en memoria (array)
$productos = [
    ["id" => 1, "nombre" => "Laptop", "precio" => 800],
    ["id" => 2, "nombre" => "Mouse", "precio" => 20],
];

// Detectar método HTTP
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Listar productos
    header('Content-Type: application/json');
    echo json_encode($productos);
}

elseif ($method === 'POST') {
    // Agregar producto
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['nombre']) && isset($input['precio'])) {
        $nuevo = [
            "id" => count($productos) + 1,
            "nombre" => $input['nombre'],
            "precio" => $input['precio']
        ];
        $productos[] = $nuevo;

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
?>