<?php

use App\Ingredient;
use App\Recipe;

class RecipeTest extends TestCase
{
    /** @test */
    public function can_add_a_new_recipe()
    {
        $this->post('/recipes', ['name' => 'Test recipe'])
            ->seeInDatabase('recipes', ['name' => 'Test recipe'])
            ->assertResponseStatus(200);

        $this->assertContains('Test recipe', $this->response->content());
    }

    /** @test */
    public function a_name_is_required_when_adding_a_recipe()
    {
        $this->post('/recipes', [])->assertResponseStatus(422);
    }

    /** @test */
    public function can_fetch_a_recipe_with_its_ingredients()
    {
        $recipe = factory(Recipe::class)->create();
        $ingredient = factory(Ingredient::class)->create(['recipe_id' => $recipe->id]);

        $this->get('/recipes/' . $recipe->id)
            ->assertResponseStatus(200);

        $this->assertContains($recipe->name, $this->response->content());
        $this->assertContains($ingredient->name, $this->response->content());
    }

    /** @test */
    public function can_search_for_recipes_by_an_ingredient()
    {
        $recipe = factory(Recipe::class)->create();
        $ingredient = factory(Ingredient::class)->create(['recipe_id' => $recipe->id]);

        $this->get('/ingredients/recipes?ingredient=' . $ingredient->name)
            ->assertResponseStatus(200);

        $this->assertContains($recipe->name, $this->response->content());
    }

    /** @test */
    public function ingredient_name_is_required_when_searching_for_recipes()
    {
        $this->get('/ingredients/recipes')->assertResponseStatus(422);
    }
}
