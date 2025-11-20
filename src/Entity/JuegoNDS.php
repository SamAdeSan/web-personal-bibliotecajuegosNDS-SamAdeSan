<?php

namespace App\Entity;

use App\Repository\JuegoNDSRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoNDSRepository::class)]
class JuegoNDS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $genero = null;

    #[ORM\Column(length: 4)]
    private ?string $fechaLanzamiento = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Biblioteca $biblioteca = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getFechaLanzamiento(): ?string
    {
        return $this->fechaLanzamiento;
    }

    public function setFechaLanzamiento(string $fechaLanzamiento): static
    {
        $this->fechaLanzamiento = $fechaLanzamiento;

        return $this;
    }

    public function getBiblioteca(): ?Biblioteca
    {
        return $this->biblioteca;
    }

    public function setBiblioteca(?Biblioteca $biblioteca): static
    {
        $this->biblioteca = $biblioteca;

        return $this;
    }
}
