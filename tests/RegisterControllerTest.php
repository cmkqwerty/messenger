<?php

use PHPUnit\Framework\TestCase;
use DI\Container;
use App\Http\HttpKernel;
use DI\Bridge\Slim\Bridge as App;
use App\Http\Controllers\RegisterController;
use App\Support\RequestInput;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class RegisterControllerTest extends TestCase
{
    private $app;

    public function setUp(): void
    {
        // Create a slim app instance same as bootstrap/app.php
        $app = App::create(new Container);
        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();

        // Bootstrap HttpKernel
        $app = HttpKernel::bootstrap($app)->getApplication();

        // Set the instance to global variable
        $this->app = $app;
    }

    public function testSuccessfulRegister() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/register');
        $response = (new ResponseFactory())->createResponse();

        // Send successful register arguments
        $request = $request->withParsedBody(['first_name' => 'Test', 'last_name' => 'Test', 'email' => 'cmkqwerty6@gmail.com', 'password' => '123456']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('register');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $registerController = new RegisterController();

        // Call the store method
        $result = $registerController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testUnsuccessfulRegister() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/register');
        $response = (new ResponseFactory())->createResponse();

        // Send same email, so it will fail
        $request = $request->withParsedBody(['first_name' => 'Test', 'last_name' => 'Test', 'email' => 'cmkqwerty6@gmail.com', 'password' => '123456']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('register');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $registerController = new RegisterController();

        // Call the store method
        $result = $registerController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(400, $result->getStatusCode());
    }

    public function testBadRegisterAttempt() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/register');
        $response = (new ResponseFactory())->createResponse();

        // Send wrong parameters, so validation will fail
        $request = $request->withParsedBody(['name' => 'Test', '' => 'Test', 'password' => '123456']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('register');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $registerController = new RegisterController();

        // Call the store method
        $result = $registerController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(400, $result->getStatusCode());
    }
}