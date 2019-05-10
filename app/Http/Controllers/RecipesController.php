<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
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
