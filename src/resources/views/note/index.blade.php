@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Note</h3>
                    <div class="card-tools">
                        
                    </div>
                </div>
                <form id="frm-add-note">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-border" id="note-title" name="title" placeholder="Note title ...">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control border-0" placeholder="Enter content ..." name="content" id="note-content"></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn" id="btn-note-save">
                            <i class="fas fa-save"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row" id="note-list"></div>
</div>
@endsection

@section('scripts')
    <script>
        const variable = {
            route_create_note: "{{ route('note.create') }}",
            route_get_notes: "{{ route('note.index') }}",
            route_delete_note: "{{ route('note.delete', ':id') }}",
            route_edit_note: "{{ route('note.update', ':id') }}",
            route_note_detail: "{{ route('note.detail', ':id') }}",
        }
    </script>
    <script src="{{ asset('js/note.js') }}"></script><script src=""></script>
@endsection