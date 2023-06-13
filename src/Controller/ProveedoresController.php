<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class ProveedoresController
{

    #[Route('/')]
    public function index(): Response
    {
        return new Response('Página Principal!');
    }

    #[Route('/proveedores/{id}')]
    public function proveedor(string $id = null): Response
    {
        if ($id) {
            // $proveedor = str_replace('-', ' ', $id);
            $proveedor = u(str_replace('-', ' ', $id))->title(true);
        } else {
            $proveedor = "Listado de Proveedores";
        }
        
        return new Response($proveedor);
    }

}