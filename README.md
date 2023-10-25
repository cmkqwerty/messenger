# Messenger

## Description

This is a simple chat application backend written in **PHP** using the **Slim Framework**. Users can create chat groups, join these groups, and send messages within them. The data is stored in an **SQLite** database, and communication between the client and server happens over a **RESTful** JSON API over HTTP(s).

## Prerequisites

- PHP
- Composer
- SQLite

## Installation

1. Clone the repository.
2. Run `composer install` to install the dependencies.
3. Run `php -S localhost:8888 -t public` to start the server.

## Usage

### API Endpoints

[![Run in Postman](https://run.pstmn.io/button.svg)](https://galactic-moon-743404.postman.co/workspace/Team-Workspace~a71e62b7-e5f2-4346-8a67-ddc5698c3e37/collection/14282633-b899e428-37f1-49a9-9392-b3a5b432c252?action=share&creator=14282633)

You can also find JSON collection in **/docs** directory.

- **Register:**
    - Endpoint: `POST /api/register`
    - Description: Create a new user.
    - Request Body:
        - `first_name`: Firstname of the user.
        - `last_name`: Surname of the user.
        - `email`: Email of the user.
        - `password`: Password of the user.


- **Login:**
    - Endpoint: `POST /api/login`
    - Description: Login as a user.
    - Request Body:
        - `email`: Email of the user.
        - `password`: Password of the user.


- **Create a Group:**
    - Endpoint: `POST /api/groups`
    - Description: Create a new chat group.
    - Request Body:
        - `name`: The name of the group.


- **List of all Groups:**
    - Endpoint: `GET /api/groups`
    - Description: Retrieve a list of all available chat groups.


- **Join a Group:**
    - Endpoint: `POST /api/groups/{group_id}/join`
    - Description: Allow the user to join a specific chat group.
    - Header:
        - `Authorization`: The user's Bearer JWT token.


- **List Messages in a Group:**
    - Endpoint: `GET /api/groups/{group_id}/messages`
    - Description: Retrieve all messages within a specific chat group.
    - Header:
      - `Authorization`: The user's Bearer JWT token.


- **Send a Message:**
    - Endpoint: `POST /api/groups/{group_id}/messages`
    - Description: Send a message to a specific chat group.
    - Request Body:
      - `content`: Content of the message.
    - Header:
      - `Authorization`: The user's Bearer JWT token.


### Run Tests
```
./vendor/bin/phpunit tests/RegisterControllerTest.php; ./vendor/bin/phpunit tests/LoginControllerTest.php; ./vendor/bin/phpunit tests/GroupControllerTest.php
```
- Hardcoded values ​​were used in some tests.
## Contributing

Feel free to contribute to the development of this project by opening issues or submitting pull requests.


### Author
- [Cem EKE](https://github.com/cmkqwerty)