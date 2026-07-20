<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Ai_Chat_MessagesService;

class Ai_Chat_MessagesController extends Controller
{
    public function __construct(
        private Ai_Chat_MessagesService $service
    ) {}

    // GET /ai_chat_messagess
    public function index(Request $request, Response $response): void
    {
        $ai_chat_messagess = $this->service->all();
        $this->view('ai_chat_messagess.index', compact('ai_chat_messagess'));
    }

    // GET /ai_chat_messagess/create
    public function create(Request $request, Response $response): void
    {
        $this->view('ai_chat_messagess.create');
    }

    // POST /ai_chat_messagess
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('ai_chat_messagess.index');
    }

    // GET /ai_chat_messagess/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('ai_chat_messagess.show', compact('record'));
    }

    // GET /ai_chat_messagess/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('ai_chat_messagess.edit', compact('record'));
    }

    // PUT /ai_chat_messagess/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('ai_chat_messagess.index');
    }

    // DELETE /ai_chat_messagess/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('ai_chat_messagess.index');
    }
}