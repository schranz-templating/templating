<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\TemplateHandler::class, 'home');
    $app->get('/twig', App\Handler\TemplateTwigHandler::class, 'twig');
    $app->get('/plates', App\Handler\TemplatePlatesHandler::class, 'plates');
    $app->get('/handlebars', App\Handler\TemplateHandlebarsHandler::class, 'handlebars');
    $app->get('/mustache', App\Handler\TemplateMustacheHandler::class, 'mustache');
    $app->get('/smarty', App\Handler\TemplateSmartyHandler::class, 'smarty');
    $app->get('/mezzio-template', App\Handler\TemplateMezzioTemplateHandler::class, 'mezzio');
    $app->get('/latte', App\Handler\TemplateLatteHandler::class, 'latte');
    $app->get('/blade', App\Handler\TemplateBladeHandler::class, 'blade');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
};
