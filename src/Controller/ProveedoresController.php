<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
        return $this->render('principal.html.twig');
    }



    #[Route('/proveedores/registro', name: 'registrarProveedor')]
    public function registrarProveedor(): Response
    {
        return $this->render('proveedor/registro.html.twig', [
            'title' => 'Registrar Proveedor'
        ]);
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

        // Guardo los datos del formulario
        $nuevoProveedor = [
            'nombre' => $request->request->get('nombre'),
            'email' => $request->request->get('email'),
            'telefono' => $request->request->get('telefono'),
            'tipo' => $request->request->get('tipo'),
            'activo' => $request->request->get('activo')
        ];

        // Valido los datos
        $validador = Validation::createValidator();

        $requisitos = new Assert\Collection([
            'nombre' => [
                new Assert\NotBlank(['message' => 'El nombre es obligatorio.']),
                new Assert\Type(['type' => 'string', 'message' => 'El nombre debe ser un texto.']),
                new Assert\Length(['max' => 30, 'maxMessage' => 'El nombre no puede tener más de {{ limit }} caracteres.']),
            ],
            'email' => [
                new Assert\NotBlank(['message' => 'El campo email es obligatorio.']),
                new Assert\Email(['message' => 'El email ingresado no es una dirección de correo electrónico válida.'])
            ],
            'telefono' => [
                new Assert\Regex([
                    'pattern' => '/^\+?[0-9]{9,11}$/',
                    'message' => 'El teléfono puede empezar con el símbolo "+" y tener entre 9 y 11 dígitos.',
                ]),
            ],
            'tipo' => [
                new Assert\Choice([
                    'choices' => ['hotel', 'pista', 'complemento'],
                    'message' => 'El campo tipo solo puede tener los valores "Hotel", "Pista" o "Complemento".',
                ]),
            ],
            'activo' => [
                new Assert\Choice([
                    'choices' => ['true', 'false'],
                    'message' => 'El campo tipo solo puede tener los valores "Si" o "No".',
                ]),
            ],
        ]);

        $errores = $validador->validate($nuevoProveedor, $requisitos);

        $mensajesError = [];
        if (count($errores) > 0) {
            foreach ($errores as $error) {
                $mensajesError[substr($error->getPropertyPath(), 1, -1)] = $error->getMessage();
            }

            $mensajesError['datos'] = $nuevoProveedor;
            
            return $this->render('proveedor/editar.html.twig', [
                'title' => 'Datos del Proveedor',
                'proveedor' => $mensajesError,
                'id' => $id
            ]);

        }

        // Datos validados. Compruebo que el correo no este registrado ya en la base de datos y que no sea suyo.
        $emailExistente = $this->entityManager->getRepository(Proveedores::class)->findOneBy(['email' => $nuevoProveedor['email']]);

        if ($emailExistente && $emailExistente->getId() != $id) {
            $mensajesError['datos'] = $nuevoProveedor;
            $mensajesError['existente'] = "Email ya registrado. Pruebe con otro.";
            return $this->render('proveedor/registro.html.twig', [
                'title' => 'Registrar Proveedor',
                'proveedor' => $mensajesError
            ]);
        }

        // Doy formato a los datos
        $nuevoProveedor['nombre'] = ucwords(strtolower($nuevoProveedor['nombre']));
        $nuevoProveedor['email'] = strtolower($nuevoProveedor['email']);
        if ($nuevoProveedor['activo'] == 'true') $nuevoProveedor['activo'] = true;
        else $nuevoProveedor['activo'] = false;

        // Modifico los datos
        $proveedor->setNombre($nuevoProveedor['nombre']);
        $proveedor->setEmail($nuevoProveedor['email']);
        $proveedor->setTelefono($nuevoProveedor['telefono']);
        $proveedor->setTipo($nuevoProveedor['tipo']);
        $proveedor->setActivo($nuevoProveedor['activo']);

        $this->entityManager->flush();

        // Vuelvo a recuperar todos los proveedores para mandarselos a la vista
        $proveedores = $repositorio->findAll();

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores,
        ]);
    }


    #[Route('/proveedores/crear', name: 'crearProveedor')]
    public function crearProveedor(Request $request, ObjectManager $manager): Response
    {

        // Guardo los datos del formulario
        $nuevoProveedor = [
            'nombre' => $request->request->get('nombre'),
            'email' => $request->request->get('email'),
            'telefono' => $request->request->get('telefono'),
            'tipo' => $request->request->get('tipo'),
            'activo' => $request->request->get('activo')
        ];

        // Valido los datos
        $validador = Validation::createValidator();

        $requisitos = new Assert\Collection([
            'nombre' => [
                new Assert\NotBlank(['message' => 'El nombre es obligatorio.']),
                new Assert\Type(['type' => 'string', 'message' => 'El nombre debe ser un texto.']),
                new Assert\Length(['max' => 30, 'maxMessage' => 'El nombre no puede tener más de {{ limit }} caracteres.']),
            ],
            'email' => [
                new Assert\NotBlank(['message' => 'El campo email es obligatorio.']),
                new Assert\Email(['message' => 'El email ingresado no es una dirección de correo electrónico válida.'])
            ],
            'telefono' => [
                new Assert\Regex([
                    'pattern' => '/^\+?[0-9]{9,11}$/',
                    'message' => 'El teléfono puede empezar con el símbolo "+" y tener entre 9 y 11 dígitos.',
                ]),
            ],
            'tipo' => [
                new Assert\Choice([
                    'choices' => ['hotel', 'pista', 'complemento'],
                    'message' => 'El campo tipo solo puede tener los valores "Hotel", "Pista" o "Complemento".',
                ]),
            ],
            'activo' => [
                new Assert\Choice([
                    'choices' => ['true', 'false'],
                    'message' => 'El campo tipo solo puede tener los valores "Si" o "No".',
                ]),
            ],
        ]);

        $errores = $validador->validate($nuevoProveedor, $requisitos);

        $mensajesError = [];
        if (count($errores) > 0) {
            foreach ($errores as $error) {
                $mensajesError[substr($error->getPropertyPath(), 1, -1)] = $error->getMessage();
            }

            $mensajesError['datos'] = $nuevoProveedor;
            
            return $this->render('proveedor/registro.html.twig', [
                'title' => 'Registrar Proveedor',
                'proveedor' => $mensajesError
            ]);

        }

        // Datos validados. Compruebo que el correo no este registrado ya en la base de datos.
        $emailExistente = $this->entityManager->getRepository(Proveedores::class)->findOneBy(['email' => $nuevoProveedor['email']]);

        if ($emailExistente) {
            $mensajesError['datos'] = $nuevoProveedor;
            $mensajesError['existente'] = "Email ya registrado. Pruebe con otro.";
            return $this->render('proveedor/registro.html.twig', [
                'title' => 'Registrar Proveedor',
                'proveedor' => $mensajesError
            ]);
        }

        // Doy formato a los datos
        $nuevoProveedor['nombre'] = ucwords(strtolower($nuevoProveedor['nombre']));
        $nuevoProveedor['email'] = strtolower($nuevoProveedor['email']);
        if ($nuevoProveedor['activo'] == 'true') $nuevoProveedor['activo'] = true;
        else $nuevoProveedor['activo'] = false;

        // Guardo el nuevo proveedor a la base de datos
        $proveedor = new Proveedores();
        $proveedor->setNombre($nuevoProveedor['nombre']);
        $proveedor->setEmail($nuevoProveedor['email']);
        $proveedor->setTelefono($nuevoProveedor['telefono']);
        $proveedor->setTipo($nuevoProveedor['tipo']);
        $proveedor->setActivo($nuevoProveedor['activo']);

        $manager->persist($proveedor);
        $manager->flush();

        // Vuelvo a recuperar todos los proveedores para mandarselos a la vista
        $repositorio = $this->entityManager->getRepository(Proveedores::class);
        $proveedores = $repositorio->findAll();

        return $this->render('proveedor/index.html.twig', [
            'title' => 'Listado de Proveedores',
            'proveedores' => $proveedores
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