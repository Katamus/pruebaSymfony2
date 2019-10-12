<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tablero
 *
 * @ORM\Table(name="tablero", indexes={@ORM\Index(name="idUsuario_idx", columns={"idUsuario"})})
 * @ORM\Entity
 */
class Tablero
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTablero", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtablero;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=16, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=true)
     */
    private $estado;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $idusuario;

    public function getIdtablero(): ?int
    {
        return $this->idtablero;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdusuario(): ?Usuario
    {
        return $this->idusuario;
    }

    public function setIdusuario(?Usuario $idusuario): self
    {
        $this->idusuario = $idusuario;

        return $this;
    }


}
