<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $request->user()->notes;
    }

    public function store(Request $request)
    {
        $this->validateNote($request);
        return $request->user()->notes()->create($request->only(['title', 'body']));
    }

    public function show(Note $note)
    {
        $this->authorize('touch', $note);

        return $note;
    }

    public function update(Note $note, Request $request)
    {
        $this->authorize('touch', $note);

        $this->validateNote($request);

        $note->update($request->only(['title', 'body']));
        $note->fresh();

        return $note;
    }

    public function destroy(Note $note)
    {
        $this->authorize('touch', $note);
        $note->delete();
    }

    protected function validateNote(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
    }
}
