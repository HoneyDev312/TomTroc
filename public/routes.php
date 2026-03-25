<?php

declare(strict_types=1);

use App\Controllers\BooksController;
use App\Controllers\AccountController;
use App\Controllers\MessageController;

/**
 * $router est fourni par index.php.
 * On déclare ici toutes les routes du projet.
 */

$r = $router->get('/', [BooksController::class, 'showHome'])->name('home');
$router->registerNamedRoute($r);

$r = $router->get('our-books', [BooksController::class, 'showOurBooks'])->name('books.show');
$router->registerNamedRoute($r);

$r = $router->get('book/{id}', [BooksController::class, 'showBook'])->name('book.show');
$router->registerNamedRoute($r);

$r = $router->get('edit-book/{id}', [BooksController::class, 'showEditBook'])->name('edit-book.show');
$router->registerNamedRoute($r);

$r = $router->post('update-book', [BooksController::class, 'updateBook'])->name('book.update');
$router->registerNamedRoute($r);

$r = $router->get('delete-book/{bookId}/{userId}', [BooksController::class, 'deleteBook'])->name('book.delete');
$router->registerNamedRoute($r);

$r = $router->get('messaging/{id}', [MessageController::class, 'showMessaging'])->name('messaging.show');
$router->registerNamedRoute($r);

$r = $router->get('signin', [AccountController::class, 'showSignIn'])->name('signin.show');
$router->registerNamedRoute($r);

$r = $router->post('connect-user', [AccountController::class, 'connectUser'])->name('signin.submit');
$router->registerNamedRoute($r);

$r = $router->get('signup', [AccountController::class, 'showSignUp'])->name('signup.show');
$router->registerNamedRoute($r);

$r = $router->post('add-user', [AccountController::class, 'addUser'])->name('signup.submit');
$router->registerNamedRoute($r);

$r = $router->post('update-my-account', [AccountController::class, 'updateMyAccount'])->name('my-account.update');
$router->registerNamedRoute($r);

$r = $router->get('my-account/{id}', [AccountController::class, 'showMyAccount'])->name('my-account.show');
$router->registerNamedRoute($r);

$r = $router->get('public-account/{id}', [AccountController::class, 'showPublicAccount'])->name('public-account.show');
$router->registerNamedRoute($r);

$r = $router->get('logout', [AccountController::class, 'logoutUser'])->name('logout');
$router->registerNamedRoute($r);
