<?php
    namespace TECWEB\MYAPI;

    use TECWEB\MYAPI\DataBase as DataBase;

    require_once __DIR__ . '/DataBase.php';

    class Products extends DataBase {

        private $data = []; //Cambiamos el data a un arreglo para almacenar los datos de manera temporal

        //Constructor que recibe los parámetros
        public function __construct($db, $user='root', $pass='290105.') {
            parent:: __construct($user, $pass, $db);
        }

        //Función para la lista de productos
        public function list(): array {
            $this->data = [];
            $sql = "SELECT * FROM productos WHERE eliminado = 0";

            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(\MYSQLI_ASSOC);
                $this->data = $rows ?: []; 
                $result->free();
            } else {
                $this->data = [
                    'status'  => 'error',
                    'message' => 'Query Error: ' . $this->conexion->error
                ];
            }
    
            $this->conexion->close();
            return $this->data; //Retorna al arreglo.
        }

        //Función para búsqueda de productos
        public function search($search): array {
            $this->data = [];
            $sql = "SELECT * FROM productos 
                    WHERE (id = '{$search}' 
                    OR nombre LIKE '%{$search}%' 
                    OR marca LIKE '%{$search}%' 
                    OR detalles LIKE '%{$search}%') 
                    AND eliminado = 0";
        
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(\MYSQLI_ASSOC);
                $this->data = $rows ?: [];
                $result->free();
            } else {
                $this->data = [
                    'status'  => 'error',
                    'message' => 'Error en la búsqueda: ' . $this->conexion->error
                ];
            }

            $this->conexion->close();
            return $this->data;
        }

        /*public function getData() {
            //Devuelve el contenido del atributo privado data y lo convierte a JSON.
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }*/

        //Función para inserción de productos
        public function add($jsonOBJ): array {
            $this->data = [];
            if (!isset($jsonOBJ->nombre)) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Datos incompletos o JSON inválido'
                ];
                return $this->data;
            }
        
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
        
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
        
                $sql = "INSERT INTO productos VALUES (
                    null, 
                    '{$jsonOBJ->nombre}', 
                    '{$jsonOBJ->marca}', 
                    '{$jsonOBJ->modelo}', 
                    {$jsonOBJ->precio}, 
                    '{$jsonOBJ->detalles}', 
                    {$jsonOBJ->unidades}, 
                    '{$jsonOBJ->imagen}', 
                    0
                )";
        
                if ($this->conexion->query($sql)) {
                    $this->data = [
                        'status' => 'success',
                        'message' => 'Producto agregado'
                    ];
                } else {
                    $this->data = [
                        'status' => 'error',
                        'message' => 'Error en la inserción: ' . mysqli_error($this->conexion)
                    ];
                }
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Ya existe un producto con ese nombre'
                ];
            }
        
            $result->free();
            $this->conexion->close();
            return $this->data;
        }

        //Función para eliminar productos
        public function delete(int $id): array {
            $this->data = [];

            if (!$id) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return $this->data;
            }
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
            if ($this->conexion->query($sql)) {
                $this->data = [
                    'status' => 'success',
                    'message' => 'Producto eliminado'
                ];
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion)
                ];
            }

            $this->conexion->close();
            return $this->data;
        }

        //Función para editar productos
        public function edit(object $jsonOBJ): array {
            $this->data = [];

            if (!isset($jsonOBJ->id)) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return $this->data;
            }
        
            $this->conexion->set_charset("utf8");
        
            $sql  = "UPDATE productos SET ";
            $sql .= "nombre='{$jsonOBJ->nombre}', ";
            $sql .= "marca='{$jsonOBJ->marca}', ";
            $sql .= "modelo='{$jsonOBJ->modelo}', ";
            $sql .= "precio={$jsonOBJ->precio}, ";
            $sql .= "detalles='{$jsonOBJ->detalles}', ";
            $sql .= "unidades={$jsonOBJ->unidades}, ";
            $sql .= "imagen='{$jsonOBJ->imagen}' ";
            $sql .= "WHERE id={$jsonOBJ->id}";
        
            if ($this->conexion->query($sql)) {
                $this->data = [
                    'status' => 'success',
                    'message' => 'Producto actualizado'
                ];
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion)
                ];
            }
        
            $this->conexion->close();
            return $this->data;
        }

        //Función para buscar por id
        public function single(int $id): array {
            $this->data = [];
            
            if (!$id) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'ID no proporcionado'
                ];
                return $this->data;
            }

            $sql = "SELECT * FROM productos WHERE id = {$id}";

            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();
                $this->data = $row ?: [
                    'status'  => 'error',
                    'message' => 'Producto no encontrado'
                ];
                $result->free();
            } else {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Error en la consulta: ' . mysqli_error($this->conexion)
                ];
            }

            $this->conexion->close();
            return $this->data;
        }

        //Búsqueda del producto por nombre en lugar de ID
        public function singleByName(string $name): array {
            $this->data = [];

            if (!$name) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Nombre no proporcionado'
                ];
                return $this->data;
            }
        
            $this->conexion->set_charset("utf8");
        
            $sql = "SELECT * FROM productos WHERE nombre = '{$name}'";
        
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();
                $this->data = $row ?: [
                    'status'  => 'error',
                    'message' => 'Producto no encontrado'
                ];
                $result->free();
                } else {
                    $this->data = [
                        'status'  => 'error',
                        'message' => 'Error en la consulta: ' . $this->conexion->error
                    ];
                }
        
                $this->conexion->close();
                return $this->data;
            }

         //Función para buscar por nombre los productos
         public function name(string $nombre): array {
            $this->data = [];

            if (!$nombre) {
                $this->data = [
                    'status' => 'error',
                    'message' => 'Nombre no proporcionado'
                ];
                return $this->data;
            }
        
            $nombre = $this->conexion->real_escape_string($nombre);
            $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
            $result = $this->conexion->query($sql);
        
            $this->data = ['existe' => false];
        
            if ($result && $result->num_rows > 0) {
                $this->data['existe'] = true;
            }
        
            if ($result) {
                $result->free();
            }
            $this->conexion->close();
            return $this->data;
        }        
    }
?>