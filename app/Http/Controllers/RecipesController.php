<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $name = $this->validate($request, [
            'name' => 'required|string'
        ])['name'];

        $recipe = Recipe::create(compact('name'));

        return response()->json([
            'success' => 'Recipe created',
            'recipe_id' => $recipe->id
        ]);
    }
}
