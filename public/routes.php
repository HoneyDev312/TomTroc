<?php

declare(strict_types=1);

use App\Controllers\BooksController;
use App\Controllers\AccountController;
use App\Controllers\MessageController;

/**
 * $router est fourni par index.php.
 * On déclare ici toutes les routes du projet.
 */

$route = $router->get('/', [BooksController::class, 'showHome'])->name('home');

$route = $router->get('our-books', [BooksController::class, 'showOurBooks'])->name('books.show');

$route = $router->get('book/{id}', [BooksController::class, 'showBook'])->name('book.show');

$route = $router->get('edit-book/{id}', [BooksController::class, 'showEditBook'])->name('edit-book.show');

$route = $router->post('update-book', [BooksController::class, 'updateBook'])->name('book.update');

$route = $router->get('delete-book/{bookId}/{userId}', [BooksController::class, 'deleteBook'])->name('book.delete');

$route = $router->get('messaging/{id}', [MessageController::class, 'showMessaging'])->name('messaging.show');

$route = $router->get('signin', [AccountController::class, 'showSignIn'])->name('signin.show');

$route = $router->post('connect-user', [AccountController::class, 'connectUser'])->name('signin.submit');

$route = $router->get('signup', [AccountController::class, 'showSignUp'])->name('signup.show');

$route = $router->post('add-user', [AccountController::class, 'addUser'])->name('signup.submit');

$route = $router->post('update-my-account', [AccountController::class, 'updateMyAccount'])->name('my-account.update');

$route = $router->post('update-my-account-picture', [AccountController::class, 'updateMyAccountPicture'])->name('my-account-picture.update');

$route = $router->post('update-book-picture', [BooksController::class, 'updateBookPicture'])->name('book-picture.update');

$route = $router->get('my-account/{id}', [AccountController::class, 'showMyAccount'])->name('my-account.show');

$route = $router->get('public-account/{id}', [AccountController::class, 'showPublicAccount'])->name('public-account.show');

$route = $router->get('logout', [AccountController::class, 'logoutUser'])->name('logout');
