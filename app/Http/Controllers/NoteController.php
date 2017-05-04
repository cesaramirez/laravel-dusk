<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * NoteController construct
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index notes
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->notes;
    }

    /**
     * Store note
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validateNote($request);
        return $request->user()->notes()->create($request->only(['title', 'body']));
    }

    /**
     * Show note
     *
     * @param  \App\Note   $note
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $this->authorize('touch', $note);

        return $note;
    }

    /**
     * Update note
     *
     * @param  \App\Note                $note
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Note $note, Request $request)
    {
        $this->authorize('touch', $note);

        $this->validateNote($request);

        $note->update($request->only(['title', 'body']));
        $note->fresh();

        return $note;
    }

    /**
     * Destroy note
     *
     * @param  \App\Note   $note
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $this->authorize('touch', $note);
        $note->delete();
    }

    /**
     * Validate Note
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Validation\Rule
     */
    protected function validateNote(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
    }
}
