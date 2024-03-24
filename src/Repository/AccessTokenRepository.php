<?php

namespace App\Repository;
use App\Entity\AccessToken;

class AccessTokenRepository extends AbstractRepository {
    protected string $entityManager = AccessToken::class;
}