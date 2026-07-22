<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Http\Request;
use Core\Http\Response;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function __construct(
        private UsersService $service,
    ) {}

    public function index(Request $request, Response $response): void
    {
       
        $usersCount = $this->service->count();
    }

    public function login(Request $request, Response $response): void
    {
        $this->view('auth.login');
    }

    public function create(Request $request, Response $response): void
    {
        $this->view('auth.register');
    }

    // POST /auth/register
    public function store(RegisterUserRequest $request, Response $response): void
    {
        $data = $request->validateForm(); // ← validated() ay hindi tinatawag automatic — dapat validateForm()

        if ($data['role'] === 'farmer' && empty($data['farm_name'])) {
            Session::flash('_errors', ['farm_name' => ['Farm name is required for farmers.']]);
            Session::flash('_old', $request->except(['password', 'password_confirmation']));
            $this->back();
            return;
        }

        $this->service->registerWithFarmProfile($data); // ← isang argument na lang

        $this->redirectRoute('home');
    }

    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('userss.show', compact('record'));
    }

    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('userss.edit', compact('record'));
    }

    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('userss.index');
    }

    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('userss.index');
    }
}