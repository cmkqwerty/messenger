<?php

use PHPUnit\Framework\TestCase;
use DI\Container;
use App\Http\HttpKernel;
use DI\Bridge\Slim\Bridge as App;
use App\Http\Controllers\GroupController;
use App\Support\RequestInput;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;
use App\Support\Token;

class GroupControllerTest extends TestCase
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

    public function testCreateGroup() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/groups');
        $response = (new ResponseFactory())->createResponse();

        // Send group name
        $request = $request->withParsedBody(['name' => 'Test']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('group');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the GroupController
        $groupController = new GroupController();

        // Call the store method
        $result = $groupController->store($requestInput, $response);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testListGroups() : void
    {
        $response = (new ResponseFactory())->createResponse();

        // Instantiate the GroupController
        $groupController = new GroupController();

        // Call the store method
        $result = $groupController->list($response);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testJoinGroup() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/groups/3/join');
        $group_id = 3;

        // Value come from JWT Token.
        $request = $request->withAttribute("token", ['data' => (object) ['id' => 1]]);

        $response = (new ResponseFactory())->createResponse();

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('group');

        // Instantiate the GroupController
        $groupController = new GroupController();

        // Call the store method
        $result = $groupController->join($request, $response, $group_id);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testListMessages() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('GET', '/groups/3/messages');
        $group_id = 3;

        // Value come from JWT Token.
        $request = $request->withAttribute("token", ['data' => (object) ['id' => 1]]);

        $response = (new ResponseFactory())->createResponse();

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('group');

        // Instantiate the GroupController
        $groupController = new GroupController();

        // Call the store method
        $result = $groupController->listMessages($request, $response, $group_id);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }

    public function testSendMessage() : void
    {
        $requestFactory = new ServerRequestFactory();
        $request = $requestFactory->createServerRequest('POST', '/groups');
        $group_id = 3;

        // Value come from JWT Token.
        $request = $request->withAttribute("token", ['data' => (object) ['id' => 1]]);

        $response = (new ResponseFactory())->createResponse();

        // Send group name
        $request = $request->withParsedBody(['content' => 'Test message.']);

        // Instantiate the RequestInput class with the mock request and route
        $route = $this->createMock(\Slim\Routing\Route::class);
        $route->method('getName')->willReturn('group');

        $requestInput = new RequestInput($request, $route);

        // Instantiate the GroupController
        $groupController = new GroupController();

        // Call the store method
        $result = $groupController->sendMessage($request, $requestInput, $response, $group_id);

        // Perform assertions based on the expected behavior
        $this->assertSame(200, $result->getStatusCode());
    }
}