<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarea
 *
 * @ORM\Table(name="tarea", indexes={@ORM\Index(name="idLista_idx", columns={"idLista"})})
 * @ORM\Entity
 */
class Tarea
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtarea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechacreacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaActualizacion", type="datetime", nullable=true)
     */
    private $fechaactualizacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaFinalizacion", type="datetime", nullable=true)
     */
    private $fechafinalizacion;

    /**
     * @var \Lista
     *
     * @ORM\ManyToOne(targetEntity="Lista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLista", referencedColumnName="idLista")
     * })
     */
    private $idlista;

    public function getIdtarea(): ?int
    {
        return $this->idtarea;
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

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechacreacion(): ?\DateTimeInterface
    {
        return $this->fechacreacion;
    }

    public function setFechacreacion(\DateTimeInterface $fechacreacion): self
    {
        $this->fechacreacion = $fechacreacion;

        return $this;
    }

    public function getFechaactualizacion(): ?\DateTimeInterface
    {
        return $this->fechaactualizacion;
    }

    public function setFechaactualizacion(?\DateTimeInterface $fechaactualizacion): self
    {
        $this->fechaactualizacion = $fechaactualizacion;

        return $this;
    }

    public function getFechafinalizacion(): ?\DateTimeInterface
    {
        return $this->fechafinalizacion;
    }

    public function setFechafinalizacion(?\DateTimeInterface $fechafinalizacion): self
    {
        $this->fechafinalizacion = $fechafinalizacion;

        return $this;
    }

    public function getIdlista(): ?Lista
    {
        return $this->idlista;
    }

    public function setIdlista(?Lista $idlista): self
    {
        $this->idlista = $idlista;

        return $this;
    }


}
