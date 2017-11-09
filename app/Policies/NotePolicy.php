<?php

namespace App\Policies;

use App\Note;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Policy on touch note.
     *
     * @param \App\User $user
     * @param \App\Note $note
     *
     * @return bool
     */
    public function touch(User $user, Note $note)
    {
        return $note->user_id == $user->id;
    }
}
