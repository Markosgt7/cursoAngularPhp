<?php
include "../config/Conexion.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, PATCH');
header('Access-Control-Max-Age: 86000');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

class CategoriaController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createCategoria($data) {
        try {
            // Validación básica de los datos
            if (empty($data['cat_nom']) || empty($data['cat_obs']) || empty($data['cat_est'])) {
                throw new InvalidArgumentException('Todos los campos son requeridos');
            }

            $sql = "INSERT INTO categorias (cat_nom, cat_obs, cat_est) VALUES (:cat_nom, :cat_obs, :cat_est)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':cat_nom', $data['cat_nom']);
            $stmt->bindParam(':cat_obs', $data['cat_obs']);
            $stmt->bindParam(':cat_est', $data['cat_est']);
            $stmt->execute();

            return json_encode([
                "status" => "success",
                "code" => 200,
                "message" => "Categoría creada con éxito"
            ]);

        } catch (PDOException $e) {
            return json_encode([
                "status" => "error",
                "code" => 500,
                "message" => $e->getMessage()
            ]);
        } catch (InvalidArgumentException $e) {
            return json_encode([
                "status" => "error",
                "code" => 400,
                "message" => $e->getMessage()
            ]);
        }
    }
}

// Inicialización y ejecución
$controller = new CategoriaController($pdoCon);
$data = [
    'cat_nom' => $_POST['cat_nom'] ?? null,
    'cat_obs' => $_POST['cat_obs'] ?? null,
    'cat_est' => $_POST['cat_est'] ?? null,
];
echo $controller->createCategoria($data);
