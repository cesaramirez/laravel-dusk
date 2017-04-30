<?php

namespace App\Policies;

use App\{Note, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function touch(User $user, Note $note)
    {
        return $note->user_id == $user->id;
    }
}
