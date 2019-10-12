<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lista
 *
 * @ORM\Table(name="lista", indexes={@ORM\Index(name="idTablero_idx", columns={"idTablero"})})
 * @ORM\Entity
 */
class Lista
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLista", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlista;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=16, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=225, nullable=false)
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
     * @var \Tablero
     *
     * @ORM\ManyToOne(targetEntity="Tablero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTablero", referencedColumnName="idTablero")
     * })
     */
    private $idtablero;


}
