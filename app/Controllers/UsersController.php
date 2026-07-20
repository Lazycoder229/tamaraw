<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UsersService;
use App\Services\Farmer_ProfilesService;

class UsersController extends Controller
{
    public function __construct(
        private UsersService $service,
        private Farmer_ProfilesService $farmerProfilesService,
    ) {}

    // GET /userss
    public function index(Request $request, Response $response): void
    {
        $users = $this->service->all();
        $usersCount = $this->service->count();
        $this->view('users.index', ['users' => $users, 'usersCount' => $usersCount]);
    }

    public function login(Request $request, Response $response): void
    {
        $this->view('auth.login');
    }

    // GET /auth/create — blangkong form lang
    public function create(Request $request, Response $response): void
    {
        $this->view('auth.register');
    }

    // POST /auth/register — validated na ang data pagdating dito
    public function store(RegisterUserRequest $request, Response $response): void
    {
        $data = $request->validated();

        $this->service->registerWithFarmProfile($data, $this->farmerProfilesService);

        $this->redirectRoute('home');
    }

    // GET /userss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('userss.show', compact('record'));
    }

    // GET /userss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('userss.edit', compact('record'));
    }

    // PUT /userss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('userss.index');
    }

    // DELETE /userss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('userss.index');
    }
}