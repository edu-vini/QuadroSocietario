<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\Type\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/usuario')]
class UsuarioController extends AbstractController {

    private UsuarioRepository $usuarioRepository;
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UsuarioRepository $usuarioRepository, UserPasswordHasherInterface $passwordHasher){
        $this->usuarioRepository = $usuarioRepository;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route(path: '/incluir', name: 'form_usuario')]
    public function new(Request $request): Response {
        
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $usuario = $form->getData();
            $senhaCriptografada = $this->passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($senhaCriptografada);
            $this->usuarioRepository->save($usuario);

            return $this->redirectToRoute('list_usuario');
        }

        return $this->render('usuario/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route(path: '/{id}', name: 'form_usuario_edit')]
    public function edit(int $id, Request $request): Response {
        
        $usuario = $this->usuarioRepository->find($id);
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $usuario = $form->getData();
            $senhaCriptografada = $this->passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($senhaCriptografada);
            $this->usuarioRepository->save($usuario);

            return $this->redirectToRoute('list_usuario');
        }

        return $this->render('usuario/new.html.twig',[
            'form' => $form
        ]);
    }

    #[Route(path: '/{id}/excluir', name: 'delete_usuario')]
    public function delete(int $id): Response {
        $this->usuarioRepository->delete($id);
        return $this->redirectToRoute('list_usuario');
    }

    #[Route(path: '', name: 'list_usuario')]
    public function list(): Response {
        return $this->render('usuario/list.html.twig', [
            'list' => $this->usuarioRepository->findAll()
        ]);
    }
}