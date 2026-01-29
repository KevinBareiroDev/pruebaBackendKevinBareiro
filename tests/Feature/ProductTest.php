<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        Currency::create([
            'name' => 'US Dollar',
            'symbol' => 'USD',
            'exchange_rate' => 1.0000,
        ]);
    }

    public function test_can_list_products(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_product(): void
    {
        $currency = Currency::first();

        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99,
            'currency_id' => $currency->id,
            'tax_cost' => 9.99,
            'manufacturing_cost' => 50.00,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test Product')
            ->assertJsonPath('data.price', '99.99');

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    public function test_can_show_product(): void
    {
        $product = Product::factory()->create(['name' => 'Show Test Product']);

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Show Test Product');
    }

    public function test_can_update_product(): void
    {
        $product = Product::factory()->create();

        $updateData = [
            'name' => 'Updated Product Name',
            'price' => 199.99,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Updated Product Name');

        $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
    }

    public function test_can_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product deleted successfully']);

        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    public function test_validation_fails_when_creating_product_without_required_fields(): void
    {
        $response = $this->postJson('/api/products', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'description', 'price', 'currency_id', 'tax_cost', 'manufacturing_cost']);
    }
}
