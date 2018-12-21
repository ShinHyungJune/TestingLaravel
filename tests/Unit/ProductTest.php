<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp()
    {
        $this->product = new Product('Fallout 4', 50);
    }

    /** @test **/
    public function a_product_has_a_name()
    {
        $this->assertEquals('Fallout 4', $this->product->name);
    }

    /** @test **/
    function a_product_has_a_cost()
    {
        $this->assertEquals(50, $this->product->cost);
    }
}
