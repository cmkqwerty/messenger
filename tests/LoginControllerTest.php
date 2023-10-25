<?php

use PHPUnit\Framework\TestCase;
use DI\Container;
use App\Http\HttpKernel;
use DI\Bridge\Slim\Bridge as App;
use App\Http\Controllers\LoginController;
use App\Support\RequestInput;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class LoginControllerTest extends TestCase
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

    public function testSuccessfulLogin() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/login');
        $response = (new ResponseFactory())->createResponse();

        // Send successful login credentials
        $request = $request->withParsedBody(['email' => 'cemeke10@gmail.com', 'password' => '123456']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('login');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $loginController = new LoginController();

        // Call the store method
        $result = $loginController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testUnsuccessfulLogin() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/login');
        $response = (new ResponseFactory())->createResponse();

        // Send wrong password credentials
        $request = $request->withParsedBody(['email' => 'cemeke10@gmail.com', 'password' => '12345']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('login');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $loginController = new LoginController();

        // Call the store method
        $result = $loginController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(403, $result->getStatusCode());
    }

    public function testBadLoginAttempt() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/login');
        $response = (new ResponseFactory())->createResponse();

        // Send wrong request body to simulate a bad login request.
        $request = $request->withParsedBody(['ema' => 'cemeke10@gmail.com', 'password' => '123456']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('login');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the LoginController
        $loginController = new LoginController();

        // Call the store method
        $result = $loginController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(400, $result->getStatusCode());
    }
}