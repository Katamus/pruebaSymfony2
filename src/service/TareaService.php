<?php


namespace App\service;
use App\Entity\Categoria;
use App\Entity\Tarea;
use App\Entity\Lista;
use App\Entity\Categoriatarea;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use App\Dto\TareaDto;
use App\Dto\IdLabelValue;


class TareaService
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function obtenerObjetoRequest(object $data){
        $categorias = [];
        $tareaDto = new TareaDto();
        if( $data->get('nombre') !== null && !empty($data->get('nombre')) ){
            $tareaDto->setNombre($data->get('nombre'));
        }
        if( $data->get('descripcion') !== null  && !empty($data->get('descripcion'))){
            $tareaDto->setDescripcion($data->get('descripcion'));
        }

        if( $data->get('idtarea') !== null && !empty($data->get('idtarea'))){
            $tareaDto->setIdtarea ($data->get('idtarea'));
        }

        if($data->get('categorias') !== null && !empty($data->get('categorias'))){
            foreach ( $data->get('categorias') as $item) {
                $categorias[] = $item;
            }
        }

        $tareaDto->setIdCategorias($categorias);

        return $tareaDto;
    }

    public function validarDatosFormularioTarea(TareaDto $tareaDto){
        $validador = Validation::createValidator();

        $errores = [];

        $validacionNombre = $validador->validate($tareaDto->getNombre(),[
            new  NotBlank(['message' => 'El campo Nombre no puede estar vacio']),
            new Length([
                'max' => 45,
                'maxMessage' => 'El campo Nombre solo permite un maximo de {{ limit }} caracteres'
            ])
        ]);

        $validacionDescripcion = $validador->validate($tareaDto->getDescripcion(),[
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

    public function guardarTareaDTO(TareaDto $tareaDto){

        $tarea = new Tarea();

        $tarea->setEstado("1");
        $tarea->setDescripcion($tareaDto->getDescripcion());
        $tarea->setNombre($tareaDto->getNombre());
        $tarea->setFechacreacion(new \DateTime());
        $listadoRepor = $this->em->getRepository(Lista::class);
        $listado = $listadoRepor->find(1);
        $tarea->setIdlista($listado);
        $this->em->persist($tarea);


        foreach ($tareaDto->getIdCategorias() as $item){
            $categoriTarea = new Categoriatarea();
            $categoriTarea->setFechacreacion(new \DateTime());

            $categoriaDao = $this->em->getRepository(Categoria::class);
            $categoria = $categoriaDao->find($item);

            $categoriTarea->setEstado(1);
            $categoriTarea->setIdcategoria($categoria);
            $categoriTarea->setIdtarea($tarea);
            $this->em->persist($categoriTarea);

        }

        $this->em->flush();

    }


    public function consultarTarea(int $id){
        $tareaDao = $this->em->getRepository(Tarea::class);
        $tarea = $tareaDao->find($id);
        return $tarea;
    }

    public function tareaFormulario(Tarea $tarea ){

        $tareaDto = new TareaDto();
        $tareaDto->setIdtarea($tarea->getIdtarea());
        $tareaDto->setNombre($tarea->getNombre());
        $tareaDto->setDescripcion($tarea->getDescripcion());
        $idCategoriaTarea = [];

        $categoriaTareaRepo = $this->em->getRepository(Categoriatarea ::class);
        $data = $categoriaTareaRepo->findBy(['idtarea'=>$tarea->getIdtarea()]);

        foreach ($data as $items){
            $idCategoriaTarea[] =  $items->getIdcategoria()->getIdcategoria();
        }
        $tareaDto->setIdCategorias($idCategoriaTarea);
        return $tareaDto;
    }

    public function actualizarTareaDTO(Tarea $tarea, TareaDto $tareaDTO){
        $this->em->persist($tarea);

        $categoriaTareaRepo = $this->em->getRepository(Categoriatarea ::class);
        $data = $categoriaTareaRepo->findBy(['idtarea'=>$tarea->getIdtarea()]);

        foreach ($data as $items){
            $this->em->remove($items);
        }

        foreach ($tareaDTO->getIdCategorias() as $item){
            $categoriTarea = new Categoriatarea();
            $categoriTarea->setFechacreacion(new \DateTime());

            $categoriaDao = $this->em->getRepository(Categoria::class);
            $categoria = $categoriaDao->find($item);

            $categoriTarea->setEstado(1);
            $categoriTarea->setIdcategoria($categoria);
            $categoriTarea->setIdtarea($tarea);
            $this->em->persist($categoriTarea);
        }

        $this->em->flush();
    }

    public function consultarTareas(string $texto){
        $tareaDao = $this->em->getRepository(Tarea::class);
        $tareas = $tareaDao->findBy(['idlista'=>1,'estado'=>1]);
        return $tareas;
    }

    public function obtenerDtoConsultarTareas($tareas){

        $tareaDto = new TareaDto();

        $registros = [];
        foreach ($tareas as $tarea ){
            $tareaDto = new TareaDto();
            $tareaDto->setIdtarea($tarea->getIdtarea());
            $tareaDto->setNombre($tarea->getNombre());
            $tareaDto->setDescripcion($tarea->getDescripcion());
            $registros[] = $tareaDto;
        }
        return $registros;
    }


}