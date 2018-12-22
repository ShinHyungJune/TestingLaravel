<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            /*
            // 1. Visit the home page
            $browser->visit('/');

            // 2. Press a 'Click Me' Link
            $browser->clickLink('Click Me');

            // 3. See "You've been clicked, punk."
            $browser->assertSee("You've been clicked, punk.");

            // 4. Assert that the current url is /feedback
            $browser->assertPathIs('/feedback');


            // => 위처럼 시나리오 하나씩 테스트해가면서 늘려나간 후에 다 되면 한꺼번에 아래처럼 정리
            $browser->visit('/')
                ->clickLinK('Click Me')
                ->assertSee("You've been clicked, punk.")
                ->assertPathIs('/feedback');
            */
        });
    }
}
