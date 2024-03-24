<?php

namespace App\Api\Security;
use App\Repository\AccessTokenRepository;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface {
    public function __construct(
        private AccessTokenRepository $accessTokenRepository
    ){}
    public function getUserBadgeFrom(string $accessToken): UserBadge {
        $accessToken  = $this->accessTokenRepository->findByOne([
            'access_token'=>$accessToken
        ]);
        if(empty($accessToken) || $accessToken->isValid()) {
            throw new BadCredentialsException('Credenciais Inválidas!');
        }
        return new UserBadge($accessToken->getUsuarioId());
    }
}