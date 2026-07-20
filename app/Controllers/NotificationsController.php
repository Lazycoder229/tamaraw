<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\NotificationsService;

class NotificationsController extends Controller
{
    public function __construct(
        private NotificationsService $service
    ) {}

    // GET /notificationss
    public function index(Request $request, Response $response): void
    {
        $notificationss = $this->service->all();
        $this->view('notificationss.index', compact('notificationss'));
    }

    // GET /notificationss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('notificationss.create');
    }

    // POST /notificationss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('notificationss.index');
    }

    // GET /notificationss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('notificationss.show', compact('record'));
    }

    // GET /notificationss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('notificationss.edit', compact('record'));
    }

    // PUT /notificationss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('notificationss.index');
    }

    // DELETE /notificationss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('notificationss.index');
    }
}