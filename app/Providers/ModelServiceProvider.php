<?php

namespace App\Providers;

use App\Ingredient;
use App\Recipe;
use mmghv\LumenRouteBinding\RouteBindingServiceProvider;

class ModelServiceProvider extends RouteBindingServiceProvider
{
    public function boot()
    {
        $this->binder->bind('recipe', Recipe::class);
        $this->binder->bind('ingredient', Ingredient::class);
    }
}
