<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Register extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Sign Up
     * @param  \Laravel\Dusk\Browser $browser
     * @param  string  $name
     * @param  string  $email
     * @param  string  $password
     * @return void          
     */
    public function signUp(
          Browser $browser,
          $name = null,
          $email = null,
          $password = null
        )
    {
        $browser->type('@name', $name)
                ->type('@email', $email)
                ->type('@password', $password)
                ->type('@passwordConfirm', $password)
                ->press('REGISTER');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@name'            => '#name',
            '@email'           => '#email',
            '@password'        => '#password',
            '@passwordConfirm' => '#password-confirm',
        ];
    }
}
