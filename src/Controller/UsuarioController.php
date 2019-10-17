<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\form\RegisterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\service\Utilidades;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UsuarioController extends AbstractController
{
    public function registro(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $usuario = new Usuario();
        $form = $this->createForm(RegisterType::class,$usuario);
        $infoview = new Utilidades;
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $encoder = $encoder->encodePassword($usuario, $usuario->getClave());
            $usuario->setClave($encoder);
            $infoview->imprimir($usuario);
            $usuario->setEstado(1);
            $usuario->setFechacreacion(new \DateTime());

            $em = $this->getDoctrine()->getManager();

            $em->persist($usuario);
            $em->flush();
            return $this->redirectToRoute('tareas');

        }

        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
            'title'=>'Registro de usuario',
            'form' => $form->createView()
        ]);

    }

    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('usuario\login.html.twig',array(
            'error' => $error,
            'last_username' =>  $lastUserName,
            'title'=>'Login de usuarios'
        ));
;    }
}
