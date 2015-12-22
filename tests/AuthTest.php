<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testRootIsLoginPage()
    {
        $this->visit('/')
             ->see('Login')
             ->see('Email')
             ->see('Password');
    }

    public function testLoginPageLinksToSignUp()
    {
        $this->visit('/auth/login')
             ->click('Sign up')
             ->see('Register')
             ->see('Name')
             ->see('Email')
             ->see('Password')
             ->see('Confirm Password');
    }

    public function testRegisterRedirectsToArticles()

    {
      $this->visit('/auth/register')
           ->submitForm('Register', [
              'name' => 'Jimmy Zeng',
              'email' => 'jzengg@gmail.com',
              'password' => 'password',
              'password_confirmation' => 'password'
            ])
           ->see('Articles')
           ->seePageIs('/articles');
    }

    public function testMustLoginToMakeNewArticle()
    {
       $this->visit('articles')
            ->click('Make a new article')
            ->seePageIs('auth/login');
    }

    public function testCanCreateArticlesWhenLoggedIn ()
    {
      $user = factory(App\User::class)->create();

      $this->actingAs($user)
           ->visit('articles/create')
           ->submitForm('Add article', ['title' => 'First title', 'body' => 'First body'])
           ->see('First title')
           ->see('First body');
    }

    public function testArticlePageHasAuthor ()
    {
      $user = factory(App\User::class)->create(["name" => "tester"]);

      $this->actingAs($user)
           ->visit('articles/create')
           ->submitForm('Add article', ['title' => 'First title', 'body' => 'First body'])
           ->click('First title')
           ->see('By: tester')
           ->see('First title')
           ->see('First body');
    }

    public function testSingleSessionLogin ()
    {
      $user = factory(App\User::class)->create(["email" => "tester@gmail.com", "password" => "testing"]);

      $this->actingAs($user);
      $oldSessionId = $user->session_id;
      $this->actingAs($user);
      $newSessionId = $user->session_id;
      $this->assertNotEquals($oldSessionId, $newSessionId);
    }

}
