<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {

        /*
        * 1. Créer un faux client qui se comporte comme un navigateur et de pointer vers une URL 
        * 2. Remplir les champs de mon formulaire d'inscription
        * 3. Est-ce que tu peux regarder si dans ma page j'ai le message (alerte) suivante: 'Votre compte a été créé avec succès !'
        * 4. Est-ce que tu peux vérifier si je suis redirigé vers la page de login
        */

        //1
      $client = static::createClient();
      $crawler = $client->request('GET', '/register');
      $form = $crawler->selectButton('Register')->form();
      $form['register_user[email]'] = 'ekat@gmail.com';
      $form['register_user[plainPassword][first]'] = '123456';
      $form['register_user[plainPassword][second]'] = '123456';
      $form['register_user[firstname]'] = 'Katia';
      $form['register_user[lastname]'] = 'Tranchand';
   

    $client->submit($form);

        //3 ma methode d'assertion permet d'aller chercher un element dans mon DOM html dans ma page
       
    

       //4 follow

         $this->assertResponseRedirects('/login'); // Vérifier si je suis redirigé vers la page de login
         
         $client->followRedirect();
         $this->assertSelectorExists('form');

           // Check flash message is present and correct
       //   $this->assertSelectorTextContains('.alert-success', 'Votre compte a été créé avec succès !');
    }
}
