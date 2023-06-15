<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Proveedores;

class ProveedoresController extends AbstractController
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        $this->entityManager = $registry->getManager();
    }

    #[Route('/', name: 'paginaPrincipal')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/proveedores', name: 'proveedores')]
    public function mostrarProveedores(): Response
    {
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedores = $repositorio->findAll();

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores,
        ]);
    }

    #[Route('/proveedores/mostrar/{id<\d+>}', name: 'mostrarProveedor')]
    public function mostrarProveedor(string $id): Response
    {
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedor = $repositorio->find($id);
        
        return $this->render('proveedor/mostrar.html.twig', [
            'title' => 'Datos del Proveedor: ',
            'proveedor' => $proveedor,
        ]);

        // return $this->json($proveedor);

        // return new Response($proveedor);
    }

    #[Route('/proveedores/editar/{id}', name: 'editarProveedor')]
    public function editarProveedor(string $id): Response
    {
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedor = $repositorio->find($id);

        // Compruebo que ha encontrado el proveedor
        if (!$proveedor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        return $this->render('proveedor/editar.html.twig', [
            'title' => 'Datos del Proveedor: ',
            'proveedor' => $proveedor,
        ]);
    }

    #[Route('/proveedores/actualizar/{id}', name: 'actualizarProveedor')]
    public function actualizarProveedor(Request $request, string $id): Response
    {
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedor = $repositorio->find($id);

        // Compruebo que ha encontrado el proveedor
        if (!$proveedor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        // Modifico los datos
        $proveedor->setNombre($request->request->get('nombre'));
        $proveedor->setEmail($request->request->get('email'));
        $proveedor->setTelefono($request->request->get('telefono'));
        $proveedor->setTipo($request->request->get('tipo'));
        $proveedor->setActivo($request->request->get('activo'));

        $this->entityManager->flush();

        // Vuelvo a recuperar todos los proveedores para mandarselos a la vista
        $proveedores = $repositorio->findAll();

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores,
        ]);
    }

    #[Route('/proveedores/borrar/{id}', name: 'borrarProveedor')]
    public function borrarProveedor(string $id): Response
    {
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedor = $repositorio->find($id);

        // Compruebo que ha encontrado el proveedor
        if (!$proveedor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        // Elimino el proveedor
        $this->entityManager->remove($proveedor);
        $this->entityManager->flush();

        // Vuelvo a recuperar todos los proveedores para mandarselos a la vista
        $proveedores = $repositorio->findAll();

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores,
        ]);
    }

}