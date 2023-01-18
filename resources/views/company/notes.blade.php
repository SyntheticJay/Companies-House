@extends('layouts.app')
@section('title', 'View Notes')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9">
                <div class="content">
                    <div id="head">
                        <h1 class="content-title font-size-24 pull-left">
                            @if (Route::is('company.notes'))
                                Notes
                            @elseif (Route::is('company.notes.archived'))
                                Archived Notes
                            @endif
                        </h1>
                        @if (Route::is('company.notes'))
                            <a href="{{ route('company.notes.archived', $company->get('company_number')) }}" class="btn btn-dark pull-right">
                                <i class="fa fa-archive"></i>
                            </a>    
                            <a class="btn btn-dark pull-right add mr-1">
                                <i class="fa fa-plus"></i>
                            </a>    
                        @elseif (Route::is('company.notes.archived'))
                            <a href="{{ route('company.notes', $company->get('company_number')) }}" class="btn btn-dark pull-right">
                                <i class="fa fa-sticky-note"></i>
                            </a>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="my-20">
                       <div class="row">
                            <div class="col">
                                <table id="noteTable" class="table table-hover">
                                    <tbody>
                                        @if ($userNotes->count() == 0)
                                            <tr>
                                                <td class="text-center" data-noresults="true">You have no notes against {{ $company->get('company_name') }}.</td>
                                            </tr>
                                        @else
                                            @foreach ($userNotes as $note)
                                                <tr data-id="{{ $note->id }}">
                                                    <td id="note">{{ $note->note }}</td>
                                                    <td class="text-right action-btns">
                                                        @if (Route::is('company.notes'))
                                                            <a class="btn btn-dark edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form class="deleteForm" action="{{ route('company.notes.delete', ['company_id' => $company->get('company_number'), 'note_id' => $note->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>    
                                                        @elseif (Route::is('company.notes.archived'))
                                                            <form class="restoreForm" action="{{ route('company.notes.restore', ['company_id' => $company->get('company_number'), 'note_id' => $note->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-dark" type="submit">
                                                                    <i class="fa fa-undo"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="module">
        $(() => {
           @if (Route::is('company.notes'))
            $(".add").click((e) => {
                    const currentRows = $('#noteTable tbody tr');

                    if (currentRows.length == 1) {
                        const noResults = $('#noteTable tbody tr td[data-noresults="true"]');

                        if (noResults.length) {
                            noResults.parent().remove();
                        }
                    }

                    const noteTable = $('#noteTable tbody');
                    
                    noteTable.append(`
                        <tr>
                            <td id="note">
                                <input type="text" class="form-control" name="note"> 
                            </td>    
                            <td class="text-right mt-auto">
                                <a class="btn btn-dark save">
                                    <i class="fa fa-save"></i>
                                </a>
                                <a class="btn btn-danger remove">
                                    <i class="fa fa-trash"></i>    
                                </a>    
                            </td>
                        </tr>
                    `);

                    $('.save').click((e) => {
                        const closestTr = $(e.target).closest("tr");
                        const note      = closestTr.find("input[name='note']").val();
                        const route     = "{{ route('company.notes.add', $company->get('company_number')) }}";

                        $.ajax({
                            url: route,
                            method: "POST",
                            data: {
                                note: note,
                            },
                            success: (data) => {
                                if (!data.success) {
                                    toastr["error"](data.message);
                                    return;
                                }

                                window.location.reload();
                            }
                        });
                    });

                    $('.remove').click((e) => {
                        const closestTr = $(e.target).closest("tr");

                        if (closestTr.length) {
                            closestTr.remove();
                        }

                        if (noteTable.find('tr').length == 0) {
                            noteTable.append(`
                                <tr>
                                    <td class="text-center" data-noresults="true">You have no notes against {{ $company->get('company_name') }}.</td>
                                </tr>
                            `);
                        }
                    });
                });

                $(".edit").click((e) => {
                    const closestTr = $(e.target).closest("tr");
                    const noteId    = closestTr.attr("data-id");
                    const note      = closestTr.find("#note").text();

                    if (!noteId || !note) {
                        return;
                    }

                    const noteInput = $(`
                        <input type="text" class="form-control" name="note" value="${note}">
                        <small>Un-focus from the input to save.</small>
                    `);
                    closestTr.find('#note').html(noteInput);

                    noteInput.blur(() => {
                        const newNote = noteInput.val();

                        if (newNote === note) {
                            closestTr.find("#note").html(note);
                            return;
                        }

                        const route = "{{ route('company.notes.update', ['company_id' => ':comp_id', 'note_id' => ':note']) }}"
                            .replace(':comp_id', "{{ $company->get('company_number') }}")
                            .replace(':note', noteId);

                        $.ajax({
                            url: route,
                            method: "PUT",
                            data: {
                                note: newNote,
                            },
                            success: (data) => {
                                console.log(data);
                                if (data.success) {
                                    closestTr.find("#note").html(newNote);
                                }

                                toastr[data.success ? "success" : "error"](data.message);
                            }
                        });
                    });
                });
           @elseif (Route::is('company.notes.archived'))
                // code here
           @endif
        });
    </script>
@endsection
