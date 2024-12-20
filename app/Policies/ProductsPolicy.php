<?php

namespace App\Policies;

use App\Models\User;
use App\Models\products;
use Illuminate\Auth\Access\Response;

class ProductsPolicy
{

    public function modify(User $user, products $products): Response
    {
        return $user->id === $products->user_id ? Response::allow() : Response::deny('Unuthorized activity');
    }
}
