<?php

namespace App\Services;

use App\User;

class UserService
{

    public function search($request)
    {
        $queryBuilder = $this->buildQueryForOrders($request);
        return $queryBuilder->get();
    }

    private function buildQueryForOrders($request)
    {
        $queryBuilder = User::existing();
        if ($request->get('name')) {
            $queryBuilder = $queryBuilder->withName($request->get('name'));
        }
        if ($request->get('surname')) {
            $queryBuilder = $queryBuilder->withSurname($request->get('surname'));
        }
        if ($request->get('email')) {
            $queryBuilder = $queryBuilder->withEmail($request->get('email'));
        }
        if ($request->get('role')) {
            $queryBuilder = $queryBuilder->withRole($request->get('role'));
        }
        return $queryBuilder;
    }
}