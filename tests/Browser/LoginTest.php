<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * @test A User Can Sign In.
     *
     * @return void
     */
    public function aUserCanSignIn()
    {
        $user = factory(User::class)->create([
            'email'    => 'cesar@test.com',
            'password' => bcrypt('secret'),
            'name'     => 'Cesar Test'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login)
                    ->signIn($user->email, 'secret')
                    ->assertPathIs('/home')
                    ->assertSeeIn('.uk-navbar', strtoupper($user->name));
        });
    }
}
