<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
	protected $noteRepository;

    public function __construct(NoteRepository $noteRepo)
    {
        $this->noteRepository = $noteRepo;
    }

    public function create(array $data) {
        return $this->noteRepository->create($data);
    }

    public function update($id, array $data) {
        return $this->noteRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->noteRepository->delete($id);
    }

    public function getAll() {
        $user_id = auth()->user()->id;
        return $this->noteRepository->filter([
            'created_by' => $user_id,
            'deleted_at' => null
        ]);
    }

    public function get($id) {
        return $this->noteRepository->find($id);
    }

}