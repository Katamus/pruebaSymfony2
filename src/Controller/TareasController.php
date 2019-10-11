<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TareasController extends AbstractController
{
    public function index()
    {
        return $this->render('tareas/index.html.twig', [
            'title' => 'Programacion de tareas',
        ]);
    }
}
