<?php
    namespace TECWEB\MYAPI;

    //Añadimos los dos archivos, ya que se encarga de controlar ambos.
    require_once __DIR__ . '/model.php.';
    require_once __DIR__ . '/view.php.';

    class Controller {
        //Creamos variables
        private $model;
        private $view;

        //Constructor
        public function __construct(Model $model, View $view) {
            $this->model = $model;
            $this->view = $view;
        }

        public function solicitar() : void {
            $metodo = $_GET['metodo'] ?? 'list';

            switch($metodo) {
                case 'list':
                    $result = $this->model->list();
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;

                case 'search':
                    $search = $_GET['search'] ?? '';
                    $result = $this->model->search($search);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;
                
                case 'delete':
                    $id = $_GET['id'] ?? 0;
                    $result = $this->model->delete((int) $id);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;

                case 'edit':
                    $jsonData = file_get_contents('php://input');
                    $jsonOBJ  = json_decode($jsonData);
                    $result   = $this->model->edit($jsonOBJ);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;
        
                case 'single':
                    $id = $_GET['id'] ?? 0;
                    $result = $this->model->single((int) $id);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;
        
                case 'singleByName':
                    $name = $_GET['name'] ?? '';
                    $result = $this->model->singleByName($name);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;
        
                case 'name':
                    // Verificamos si existe un producto por nombre
                    $nombre = $_GET['nombre'] ?? '';
                    $result = $this->model->name($nombre);
                    $this->view->mostrar(json_encode($result, JSON_PRETTY_PRINT));
                    break;

                default:
                    $error = [
                        'status'  => 'error',
                    'message' => 'Acción no válida'
                    ];
                    $this->view->mostrar(json_encode($error, JSON_PRETTY_PRINT));
                    break;
            }
            
        }
    }

?>