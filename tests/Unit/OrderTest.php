<?php

namespace Tests\Unit;

use App\Product;
use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    public function setUp()
    {
        
    }
    /** @test */
    function an_order_consists_of_prducts()
    {
        $order = $this->createOrderWithProducts();

        $this->assertEquals(2, count($order->products()));
    }

    /** @test */
    function an_order_can_determine_the_total_cost_of_all_its_products()
    {
        $order = $this->createOrderWithProducts();

        $this->assertEquals(66, $order->total());
    }

    protected function createOrderWithProducts()
    {
        $order = new Order;

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product);
        $order->add($product2);

        return $order;
    }
}
