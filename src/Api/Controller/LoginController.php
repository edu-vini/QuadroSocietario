<?php

namespace App\Api\Controller;
use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use OpenApi\Attributes as OA;

#[Route(path: 'api/login')]
class LoginController extends AbstractController {
    public function __construct(
        private AccessTokenRepository $accessTokenRepository
    ){}

    #[Route(path: '', name: 'api_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?Usuario $usuario): Response {
        if(empty($usuario)) {
            return $this->json([
                'status'=>'error',
                'message'=>'Sem credenciais!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $accessToken = new AccessToken;
        $accessToken->setUsuario($usuario);
        $accessToken->setCriadoEm(new \DateTime);
        $accessToken->setValidoAte(new \DateTime('+6 hours'));
        $accessToken->generateToken();

        $this->accessTokenRepository->save($accessToken);

        return $this->json([
            'access_token' => $accessToken->getToken()
        ]);
    }
}

