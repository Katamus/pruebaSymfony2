<?php


namespace App\service;
use App\Entity\Categoria;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use App\Dto\CategoriaDTO;



class CategoriaService
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function obtenerObjetoRequest(object $data){
        $categoria = new CategoriaDTO();
        if( $data->get('nombre') !== null && !empty($data->get('nombre')) ){
            $categoria->setNombre($data->get('nombre'));
        }
        if( $data->get('descripcion') !== null  && !empty($data->get('descripcion'))){
            $categoria->setDescripcion($data->get('descripcion'));
        }

        if( $data->get('idcategoria') !== null && !empty($data->get('idcategoria'))){
            $categoria->setIdcategoria($data->get('idcategoria'));
        }
        return $categoria;
    }

    public function compleMentarObjeto(CategoriaDTO $categoriaDto){
        $categoria = new Categoria();
        $categoria->setEstado(1);
        $categoria->setFechacreacion(new \DateTime());
        $usuarioRepo = $this->em->getRepository(Usuario::class);
        $usuario = $usuarioRepo->findOneBy(['idusuario'=>1]);
        $categoria->setIdusuario($usuario);
        $categoria->setNombre($categoriaDto->getNombre());
        $categoria->setDescripcion($categoriaDto->getDescripcion());
        return $categoria;
    }

    public function validarDatosFormularioCategoria(CategoriaDTO $categoria){
        $validador = Validation::createValidator();

        $errores = [];

        $validacionNombre = $validador->validate($categoria->getNombre(),[
            new  NotBlank(['message' => 'El campo Nombre no puede estar vacio']),
            new Length([
                'max' => 45,
                'maxMessage' => 'El campo Nombre solo permite un maximo de {{ limit }} caracteres'
            ])
        ]);

        $validacionDescripcion = $validador->validate($categoria->getDescripcion(),[
            new  NotBlank(['message' => 'El campo Descripcion no puede estar vacio']),
            new Length([
                'max' => 225,
                'maxMessage' => 'El campo Nombre solo permite un maximo de {{ limit }} caracteres'
            ])
        ]);

        if(count($validacionNombre) != 0){
            foreach ($validacionNombre as $item) {
                $errores[] = $item->getMessage();
            }
        }
        if(count($validacionDescripcion) != 0){
            foreach ($validacionDescripcion as $item) {
                $errores[] = $item->getMessage();
            }
        }

        return $errores;
    }

    public function consultarCategoria(int $id){
        $categoriaDao = $this->em->getRepository(Categoria::class);
        $categoria = $categoriaDao->find($id);
        return $categoria;
    }

    public function guardarCategoria(Categoria $categoria){
        $this->em->persist($categoria);
        $this->em->flush();
    }

    public function categoriaFormulario(Categoria $categoriaConsulta ){
        $categoriaRespuesta  = new CategoriaDTO();
        $categoriaRespuesta->setNombre($categoriaConsulta->getNombre());
        $categoriaRespuesta->setDescripcion($categoriaConsulta->getDescripcion());
        $categoriaRespuesta->setIdcategoria($categoriaConsulta->getIdcategoria());
        return $categoriaRespuesta;
    }

    public function eliminarCategoria(Categoria $categoria){
        $this->em->remove($categoria);
        $this->em->flush();
    }
}