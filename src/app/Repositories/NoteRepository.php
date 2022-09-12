<?php

namespace App\Repositories;

use App\Models\Note;

/**
 * Class NoteRepository.
 */
class NoteRepository extends BaseRepository
{
    public function getModel()
    {
        //return YourModel::class;
        return Note::class;
    }

}
