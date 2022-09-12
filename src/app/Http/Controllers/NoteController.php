<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller {
    protected $noteService;

    public function __construct(NoteService $noteService) {
        $this->noteService = $noteService;
    }

    public function view() {
        return view('note.index');
    }

    public function index() {
        $notes = $this->noteService->getAll();
        return responseOK(new NoteCollection($notes));
    }
   
    public function create(Request $request) {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $note = $this->noteService->create($data);
            DB::commit();
            return responseOK(new NoteResource($note));
        } catch(\Exception $e) {
            return responseError($e, $e->getMessage());
        }
    }

    public function update($id, Request $request) {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $note = $this->noteService->update($id, $data);
            DB::commit();
            return responseOK(new NoteResource($note));
        } catch(\Exception $e) {
            return responseError($e, $e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $this->noteService->delete($id);
            DB::commit();
            return responseUpdatedOrDeleted();
        } catch(\Exception $e) {
            return responseError($e, $e->getMessage());
        }
    }

    public function detail($id) {
        return responseOK($this->noteService->get($id));
    }
}
