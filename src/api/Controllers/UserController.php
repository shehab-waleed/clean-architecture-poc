<?php

namespace Src\api\Controllers;

use Illuminate\Routing\Controller;
use Src\api\Requests\StoreUserRequest;
use Src\application\Commands\CreateUser\CreateUserCommand;
use Src\application\Commands\CreateUser\CreateUserCommandHandler;

class UserController extends Controller
{
    public function store(
        StoreUserRequest $request,
        CreateUserCommandHandler $createUserCommandHandler
    )
    {
        $createUserResponse = $createUserCommandHandler->handle(
            new CreateUserCommand(
                (string) $request->name,
                (string) $request->email,
                (string) $request->password
            )
        );

        return response()->json($createUserResponse, 201);
    }
}
