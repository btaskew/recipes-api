<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class IngredientsController extends Controller
{
    /**
     * @param Recipe  $recipe
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|JsonResponse
     * @throws ValidationException
     */
    public function store(Recipe $recipe, Request $request)
    {
        $name = $this->validate($request, [
            'name' => 'required|string'
        ])['name'];

        if ($recipe->ingredients()->where('name', $name)->exists()) {
            return response()->json(['error' => 'Ingredient present'], 422);
        }

        return $recipe->ingredients()->create(compact('name'));
    }
}
