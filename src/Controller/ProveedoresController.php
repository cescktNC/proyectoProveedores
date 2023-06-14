<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class ProveedoresController extends AbstractController
{

    #[Route('/')]
    public function index(): Response
    {
        $proveedores = [
            ['nombre' => 'Hotel Sant Eloi', 'email' => 'info@hotelsanteloi.com', 'tfn' => 987125475, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Estudis Crest Pas', 'email' => 'info@estudiscrestpas.com', 'tfn' => 547444112, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Antic', 'email' => 'info@hotelantic.com', 'tfn' => 452369854, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Eurostars Andorra', 'email' => 'info@eurostarsandorra.com', 'tfn' => 452147774, 'tipo' => 'hotel', 'activo' => false],
            ['nombre' => 'Hotel Andorra Park', 'email' => 'info@hotelandorrapark.com', 'tfn' => 121444558, 'tipo' => 'hotel', 'activo' => false],
            ['nombre' => 'Hotel Spa Diana Parc', 'email' => 'info@hotelspadianaparc.com', 'tfn' => 987445632, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Zènit Diplomàtic', 'email' => 'info@hotelzenitdiplomatic.com', 'tfn' => 541222365, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Yomo Centric', 'email' => 'info@hotelyomocentric.com', 'tfn' => 412111458, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Grandvalira', 'email' => 'info@grandvalira.com', 'tfn' => 474111222, 'tipo' => 'pista', 'activo' => true],
            ['nombre' => 'Baqueria Beret', 'email' => 'info@baqueiraberet.com', 'tfn' => 325552147, 'tipo' => 'pista', 'activo' => true],
            ['nombre' => 'Port Ainé', 'email' => 'info@portaine.com', 'tfn' => 471120025, 'tipo' => 'pista', 'activo' => false],
            ['nombre' => 'Caldea', 'email' => 'info@caldea.com', 'tfn' => 120325011, 'tipo' => 'complemento', 'activo' => true],
            ['nombre' => 'Hotel Avanti', 'email' => 'info@hotelavanti.com', 'tfn' => 854012336, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Acta Arthotel', 'email' => 'info@actaarthotel.com', 'tfn' => 987452147, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Espel', 'email' => 'info@hotelespel.com', 'tfn' => 125478965, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Eureka', 'email' => 'info@hoteleureka.com', 'tfn' => 125478965, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Hotel Cims', 'email' => 'info@hotelcims.com', 'tfn' => 145214001, 'tipo' => 'hotel', 'activo' => true],
            ['nombre' => 'Spa Siente Boí', 'email' => 'info@spasienteboi.com', 'tfn' => 980106781, 'tipo' => 'complemento', 'activo' => false],
            ['nombre' => 'Spa La Collada', 'email' => 'info@spalacollada.com', 'tfn' => 780197425, 'tipo' => 'complemento', 'activo' => true],
            ['nombre' => 'Inúu Wellness Attitude', 'email' => 'info@inuuwellnessattitude.com', 'tfn' => 471099870, 'tipo' => 'complemento', 'activo' => true]
        ];

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores,
        ]);
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