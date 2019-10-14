<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tarea;
use App\Dto\TareaDto;
use App\Dto\IdLabelValue;
use App\Entity\Categoria;
use App\service\CategoriaService;
use App\service\TareaService;

class TareasController extends AbstractController
{
    public function index()
    {
        return $this->render('tareas/index.html.twig', [
            'title' => 'Programacion de tareas',
        ]);
    }


    public function consultar( Request $request ){
        $texto = $request->get('texto');
        $em = $this->getDoctrine()->getManager();
        $tareaservice = new TareaService($em);

        $texto = is_null($texto) ? '' :  $texto;
        $tareas = $tareaservice->consultarTareas($texto);
        $consultaNombre = $tareaservice->obtenerDtoConsultarTareas($tareas);
        return $this->json($consultaNombre);
    }

    public function crear(){

        $session = new Session();
        $tarea = new TareaDto();
        $tarea->setIdCategorias([]);

        foreach ($session->getFlashBag()->get('tarea', []) as $tareaSession) {
            $tarea = $tareaSession;
        }
        $categoriaDao = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $categoriaDao->findBy( ['idusuario'=>1,'estado'=>1],['nombre'=>'ASC'] );

        return $this->render('tareas/formulario.html.twig', [
            'title' => 'Crear tarea',
            'categorias' => $categorias,
            'tarea' => $tarea
        ]);
    }

    public function consultarNombres(Request $request){
        $texto = $request->get('term');
        $callback = $request->get('callback');
        $condiciones = ['idlista'=>1,'estado'=>1];
        $dql = "SELECT a FROM App\Entity\Tarea a WHERE a.idlista = ".$condiciones['idlista']." and a.estado = ".$condiciones['idlista'];
        if(!empty($texto) && !is_null($texto)){
            $dql .= " and a.nombre like '%".$texto."%'";
        }
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);
        $result = $query->execute();
        $data = [];

        foreach ($result as $info){
            $idlabelvalue = new IdLabelValue();
            $idlabelvalue->setId($info->getIdtarea());
            $idlabelvalue->setLablel($info->getNombre());
            $idlabelvalue->setValue($info->getNombre());

            $data[] = $idlabelvalue;
        }
        $response = new Response();

        $json = $callback."(".$this->json($data)->getContent().")";
        $response->setContent($json);

        return $response;
    }

    public function guardar(Request $request){
        $em = $this->getDoctrine()->getManager();
        $tareaService = new  TareaService($em);
        $tareaDTO = $tareaService->obtenerObjetoRequest($request);
        $session = new Session();
        if(is_null($tareaDTO->getIdtarea()) || empty($tareaDTO->getIdtarea())){
            $errores = $tareaService->validarDatosFormularioTarea($tareaDTO);
            if( count($errores) >= 1){
                $session->getFlashBag()->add('error',$errores);
                $session->getFlashBag()->add('tarea',$tareaDTO);
                return $this->redirectToRoute('tareasCrear');
            }{
                $tareaService->guardarTareaDTO($tareaDTO);
                $session->getFlashBag()->add('sussecs','Tarea creada');
                return $this->redirectToRoute('tareas');
            }
        }else{
            $tareaConsulta = $tareaService->consultarTarea($tareaDTO->getIdtarea());
            if( is_null($tareaConsulta ) ){
                $session->getFlashBag()->add('errors','Tarea no existe');
                return $this->redirectToRoute('tareas');
            }
            $errores = $tareaService->validarDatosFormularioTarea($tareaDTO);
            if( count($errores) >= 1){
                $session->getFlashBag()->add('error',$errores);
                $session->getFlashBag()->add('tarea',$tareaDTO);
                return $this->redirectToRoute('tareasCrear');
            }{

                $tareaConsulta->setDescripcion($tareaDTO->getDescripcion());
                $tareaConsulta->setNombre($tareaDTO->getNombre());
                $tareaService->actualizarTareaDTO($tareaConsulta,$tareaDTO);

                $session->getFlashBag()->add('sussecs','Tarea modificada');
                return $this->redirectToRoute('tareas');
            }
        }
    }

    public function editar($id){
        $session = new Session();
        if($id == 0){
            $session->getFlashBag()->add('errors','Error en la ruta');
            return $this->redirectToRoute('tareas');
        }

        $em = $this->getDoctrine()->getManager();
        $tareaservice = new TareaService($em);


        $tareaConsulta = $tareaservice->consultarTarea($id);

        if( is_null($tareaConsulta ) ){
            $session->getFlashBag()->add('errors','Tarea no existe');
            return $this->redirectToRoute('tareas');
        }

        $tareaDto = $tareaservice->tareaFormulario($tareaConsulta);
        $categoriaDao = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $categoriaDao->findBy( ['idusuario'=>1,'estado'=>1],['nombre'=>'ASC'] );

        return $this->render('tareas/formulario.html.twig', [
            'title' => 'Editar Tarea',
            'categorias' => $categorias,
            'tarea' => $tareaDto,
        ]);
    }

    public function eliminar($id){
        $session = new Session();
        if($id == 0){
            $session->getFlashBag()->add('errors','Error en la ruta');
            return $this->redirectToRoute('tareas');
        }

        $em = $this->getDoctrine()->getManager();
        $tareaservice = new TareaService($em);


        $tareaConsulta = $tareaservice->consultarTarea($id);

        if( is_null($tareaConsulta ) ){
            $session->getFlashBag()->add('errors','Tarea no existe');
            return $this->redirectToRoute('tareas');
        }

        $tareaConsulta->setEstado(2);

        $em->persist($tareaConsulta);
        $em->flush();

        return $this->redirectToRoute('tareas');
    }
}
