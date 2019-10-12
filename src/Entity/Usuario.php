<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreUsuario", type="string", length=16, nullable=false)
     */
    private $nombreusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=32, nullable=false)
     */
    private $clave;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $fechacreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    public function getNombreusuario(): ?string
    {
        return $this->nombreusuario;
    }

    public function setNombreusuario(string $nombreusuario): self
    {
        $this->nombreusuario = $nombreusuario;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

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

    public function getIdusuario(): ?int
    {
        return $this->idusuario;
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


}
