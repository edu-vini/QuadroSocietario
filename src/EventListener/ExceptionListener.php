<?php

namespace App\EventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ExceptionListener {
    public function __invoke(ExceptionEvent $event): void {
        $exception = $event->getThrowable();
        if( $exception instanceof NotFoundHttpException){
            throw $exception;
        }
        $event->setResponse(new JsonResponse([
            'status'=>'error',
            'message'=>$exception->getMessage()
        ]));
    }
}