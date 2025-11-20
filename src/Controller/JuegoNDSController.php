<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Entity\JuegoNDS;
use App\Repository\JuegoNDSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class JuegoNDSController extends AbstractController
{
    private array $juegos = [
        1 => [
            "nombre" => "New Super Mario Bros.",
            "genero" => "plataformas en 2d",
            "fechaLanzamiento" => 2006
        ],
        2 => [
            "nombre" => "Mario & Luigi: Partners in Time",
            "genero" => "aventura 2d y RPG",
            "fechaLanzamiento" => 2005
        ],
        3 => [
            "nombre" => "Mario Party DS",
            "genero" => "minijuegos y juegos de mesa",
            "fechaLanzamiento" => 2005
        ],
        4 => [
            "nombre" => "Mario Kart DS",
            "genero" => "carreras",
            "fechaLanzamiento" => 2005
        ],
        5 => [
            "nombre" => "Mario & Luigi: Bowser's Inside Story",
            "genero" => "aventura 2d y RPG",
            "fechaLanzamiento" => 2009
        ],
        6 => [
            "nombre" => "Worms: Open Warfare 2",
            "genero" => "acción por turnos",
            "fechaLanzamiento" => 2007
        ],
        7 => [
            "nombre" => "Warioware: Touched!",
            "genero" => "minijuegos y puzles",
            "fechaLanzamiento" => 2004
        ],
        8 => [
            "nombre" => "Nintendogs",
            "genero" => "simulación",
            "fechaLanzamiento" => 2005
        ]
    ];
    #[Route('/juegoNDS/{codigo?2}', name: 'datos_juego')]
    public function inicio(ManagerRegistry $doctrine, $codigo): Response
    {
        $repositorio = $doctrine->getRepository(JuegoNDS::class);
        $resultado = $repositorio->find($codigo);

        return $this->render('datos_juego.html.twig', [
            'juego' => $resultado
        ]);
    }

    #[Route("/juegoNDS/insertar", name: "insertar_juego")]
    public function insertar(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach($this->juegos as $j){
            $juego = new JuegoNDS();
            $juego->setNombre($j["nombre"]);
            $juego->setGenero($j["genero"]);
            $juego->setFechaLanzamiento($j["fechaLanzamiento"]);
            $entityManager->persist($juego);
        }
        try {
            // Solo se necesita realizar flush una vez y confirmará todas las operaciones
            // pendientes
            $entityManager->flush();
            return new Response("Juegos de NDS insertados");
        } catch (\Exception $e) {
            return new Response("Error insertando objetos");
        }
    }
    #[Route("/juegoNDS/buscar/{texto}", name: "buscar_juego")]
    public function buscar(ManagerRegistry $doctrine, $texto): Response
    {
        //Filtramos aquellos que contengan dicho texto en el nombre
        $repositorio = $doctrine->getRepository(JuegoNDS::class);

        $juegos = $repositorio->findByName($texto);

        return $this->render('lista_datos_juego.html.twig', [
            'juegos' => $juegos
        ]);
    }
    #[Route("/juegoNDS/update/{id}/{nombre}", name: "modificar_juego")]
    public function update(ManagerRegistry $doctrine, $id, $nombre): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(JuegoNDSRepository::class);
        $juego = $repositorio->find($id);

        if ($juego) {
            $juego->setNombre($nombre);
            try
            {
                $entityManager->flush();
                return $this->render('datos_juego.html.twig', [
                    'juego' => $juego
                ]);
            } catch (\Exception $e) {
                return new Response("Error insertando objetos");
            }
        } else {
            return $this->render('datos_juego.html.twig', [
                'juego' => null
            ]);
        }
    }
    #[Route("/juegoNDS/delete/{id}", name: "eliminar_juego")]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(JuegoNDSRepository::class);
        $juego = $repositorio->find($id);

        if ($juego) {
            try
            {
                $entityManager->remove($juego);
                $entityManager->flush();
                return new Response("Contacto eliminado");
            } catch (\Exception $e) {
                return new Response("Error eliminado objeto");
            }
        } else {
            return $this->render('ficha_contacto.html.twig', [
                'contacto' => null
            ]);
        }
    }
    #[Route("/juegoNDS/insertarConBiblioteca", name: "insertar_juego_biblioteca")]
    public function insertarConBiblioteca(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $biblioteca = new Biblioteca();

        $biblioteca->setNombre("NDS Biblioteca Central");
        $juego = new JuegoNDS();

        $juego->setNombre("Inserción de prueba con biblioteca");
        $juego->setGenero("genero desconocido");
        $juego->setFechaLanzamiento("2006");
        $juego->setBiblioteca($biblioteca);

        $entityManager->persist($biblioteca);
        $entityManager->persist($juego);

        $entityManager->flush();
        return $this->render('datos_juego.html.twig', [
            'juego' => $juego
        ]);
    }

    #[Route("/juegoNDS/insertarSinBiblioteca", name: "insertar_juego_sin_biblioteca")]
    public function insertarSinProvincia(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Biblioteca::class);

        $biblioteca = $repositorio->findOneBy(["nombre" => "Alicante"]);

        $juego = new JuegoNDS();

        $juego->setNombre("Inserción de prueba sin biblioteca");
        $juego->setGenero("genero desconocido");
        $juego->setFechaLanzamiento("2006");
        $juego->setBiblioteca($biblioteca);

        $entityManager->persist($juego);

        $entityManager->flush();
        return $this->render('datos_juego.html.twig', [
            'juego' => $juego
        ]);
    }
}