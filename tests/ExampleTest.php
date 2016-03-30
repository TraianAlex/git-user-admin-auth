<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    public function testRegistrationWorks()
    {
        $this->visit('/register');
        $this->type('test3', 'name');
        $this->type('test3@usa.com', 'email');
        $this->type('111111', 'password');
        $this->type('111111', 'password_confirmation');
        $this->press('Register');
        $this->seePageIs('/home');
        $this->see('Latest Quotes');
    }
}
