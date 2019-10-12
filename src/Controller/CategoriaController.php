<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categoria;
use App\service\CategoriaService;
use App\Dto\CategoriaDTO;
use Symfony\Component\HttpFoundation\Session\Session;


class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria")
     */
    public function index()
    {
        $categoriaDao = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $categoriaDao->findBy( ['idusuario'=>1],['nombre'=>'ASC'] );

        return $this->render('categoria/index.html.twig', [
            'title' => 'Categorias',
            'categorias' =>$categorias
        ]);
    }

    public function crear(){

        $session = new Session();
        $categoria = new Categoria();


        foreach ($session->getFlashBag()->get('categoria', []) as $categoriaSession) {
            $categoria = $categoriaSession;
        }

        return $this->render('categoria/formulario.html.twig', [
            'title' => 'Crear categoria',
            'categoria' => $categoria
        ]);
    }

    public function guardar(Request $request){
        $em = $this->getDoctrine()->getManager();
        $categoriaservice = new CategoriaService($em);
        $categoriaDTO = $categoriaservice->obtenerObjetoRequest($request);
        $session = new Session();
        if(is_null($categoriaDTO->getIdcategoria()) || empty($categoriaDTO->getIdcategoria())){
            $errores = $categoriaservice->validarDatosFormularioCategoria($categoriaDTO);
            if( count($errores) >= 1){
                $session->getFlashBag()->add('error',$errores);
                $session->getFlashBag()->add('categoria',$categoriaDTO);
                return $this->redirectToRoute('categoriaCrear');
            }{
                $categoria = $categoriaservice->compleMentarObjeto($categoriaDTO);
                $categoriaservice->guardarCategoria($categoria);
                $session->getFlashBag()->add('sussecs','Dato ingresado correctamente');
                return $this->redirectToRoute('categoria');
            }
        }else{

            $categoriaConsulta = $categoriaservice->consultarCategoria($categoriaDTO->getIdcategoria());
            if( is_null($categoriaConsulta ) ){
                $session->getFlashBag()->add('errors','Categoria no existe');
                return $this->redirectToRoute('categoria');
            }
            $errores = $categoriaservice->validarDatosFormularioCategoria($categoriaDTO);
            if( count($errores) >= 1){
                $session->getFlashBag()->add('error',$errores);
                $session->getFlashBag()->add('categoria',$categoriaDTO);
                return $this->redirectToRoute('categoriaCrear');
            }{
                $categoriaConsulta->setNombre($categoriaDTO->getNombre());
                $categoriaConsulta->setDescripcion($categoriaDTO->getDescripcion());
                $categoriaservice->guardarCategoria($categoriaConsulta);
                $session->getFlashBag()->add('sussecs','Dato modificado correctamente');
                return $this->redirectToRoute('categoria');
            }

            return $this->redirectToRoute('categoria');
        }
    }


    public function editar($id){
        $session = new Session();
        if($id == 0){
            $session->getFlashBag()->add('errors','Error en la ruta');
            return $this->redirectToRoute('categoria');
        }

        $em = $this->getDoctrine()->getManager();
        $categoriaservice = new CategoriaService($em);
        $categoriaConsulta = $categoriaservice->consultarCategoria($id);


        if( is_null($categoriaConsulta ) ){
            $session->getFlashBag()->add('errors','Categoria no existe');
            return $this->redirectToRoute('categoria');
        }

        $categoriaDTO = $categoriaservice->categoriaFormulario($categoriaConsulta);

        return $this->render('categoria/formulario.html.twig', [
            'title' => 'Editar categoria',
            'categoria' => $categoriaDTO
        ]);
    }

    public function eliminar($id){
        $session = new Session();
        if($id == 0){
            $session->getFlashBag()->add('errors','Error en la ruta');
            return $this->redirectToRoute('categoria');
        }

        $em = $this->getDoctrine()->getManager();
        $categoriaservice = new CategoriaService($em);
        $categoriaConsulta = $categoriaservice->consultarCategoria($id);


        if( is_null($categoriaConsulta ) ){
            return $this->redirectToRoute('categoria');
        }
        $categoriaservice->eliminarCategoria($categoriaConsulta);
        $session->getFlashBag()->add('sussecs','Dato eliminado correctamente');
        return $this->redirectToRoute('categoria');
    }

}
