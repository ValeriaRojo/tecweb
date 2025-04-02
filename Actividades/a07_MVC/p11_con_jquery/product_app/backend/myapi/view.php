<?php
    class View {
        public function mostrar(string $data): void {
            header('Content-Type: application/json; charset=utf-8');
            echo $data;
        }
    }
?>