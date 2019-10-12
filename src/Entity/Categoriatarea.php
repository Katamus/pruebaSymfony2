<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriatarea
 *
 * @ORM\Table(name="categoriatarea", indexes={@ORM\Index(name="idTarea_idx", columns={"idTarea"}), @ORM\Index(name="idCatetare", columns={"idCategoria", "idTarea"}), @ORM\Index(name="IDX_8D3DE63CB2FA397B", columns={"idCategoria"})})
 * @ORM\Entity
 */
class Categoriatarea
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcategoriaTarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriatarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechacreacion;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="idCategoria")
     * })
     */
    private $idcategoria;

    /**
     * @var \Tarea
     *
     * @ORM\ManyToOne(targetEntity="Tarea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTarea", referencedColumnName="idTarea")
     * })
     */
    private $idtarea;

    public function getIdcategoriatarea(): ?int
    {
        return $this->idcategoriatarea;
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

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdcategoria(): ?Categoria
    {
        return $this->idcategoria;
    }

    public function setIdcategoria(?Categoria $idcategoria): self
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    public function getIdtarea(): ?Tarea
    {
        return $this->idtarea;
    }

    public function setIdtarea(?Tarea $idtarea): self
    {
        $this->idtarea = $idtarea;

        return $this;
    }


}
