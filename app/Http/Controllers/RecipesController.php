<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class RecipesController extends Controller
{
    /**
     * @param Recipe $recipe
     * @return Recipe
     */
    public function show(Recipe $recipe)
    {
        return $recipe->load('ingredients');
    }

    /**
     * @param Request $request
     * @return Recipe
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $name = $this->validate($request, [
            'name' => 'required|string'
        ])['name'];

        return Recipe::create(compact('name'));
    }
}
