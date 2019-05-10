<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class IngredientsController extends Controller
{
    /**
     * @param Recipe  $recipe
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Recipe $recipe, Request $request)
    {
        $name = $this->validate($request, [
            'name' => 'required|string'
        ])['name'];

        if ($recipe->ingredients()->where('name', $name)->exists()) {
            return response()->json(['error' => 'Ingredient present'], 422);
        }

        $recipe->ingredients()->create(compact('name'));

        return response()->json(['success' => 'Ingredient added']);
    }
}
