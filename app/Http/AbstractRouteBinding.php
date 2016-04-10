<?php
namespace App\Http;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractRouteBinding
{
    /**
     * @param int|string $value
     * @return mixed
     */
    public function bind($value)
    {
        if ($entity = $this->find($value)) {
            return $entity;
        }

        throw new NotFoundHttpException();
    }
}
