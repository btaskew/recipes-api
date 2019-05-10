<?php

use App\Recipe;

class IngredientTest extends TestCase
{
    /** @test */
    public function can_add_an_ingredient_to_a_recipe()
    {
        $recipe = factory(Recipe::class)->create();

        $this->post('recipes/' . $recipe->id . '/ingredients', ['name' => 'Test ingredient'])
            ->seeInDatabase('ingredients', ['name' => 'Test ingredient', 'recipe_id' => $recipe->id])
            ->assertResponseStatus(200);

        $this->assertContains('success', $this->response->content());
    }

    /** @test */
    public function a_name_is_required_when_adding_an_ingredient()
    {
        $recipe = factory(Recipe::class)->create();

        $this->post('recipes/' . $recipe->id . '/ingredients', [])->assertResponseStatus(422);
    }
}
