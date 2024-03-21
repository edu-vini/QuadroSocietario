<?php 

namespace App\Api;

use OpenApi\Attributes as OA;

#[OA\Info(title: "My First API", version: "0.1")]

class TestController {
    #[OA\Get(path: '/api/users')]
    #[OA\Response(response: 200, description: 'AOK')]
    #[OA\Response(response: 401, description: 'Not allowed')]
    public function index(){
        return 1;
    }
}