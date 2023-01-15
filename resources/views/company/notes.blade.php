@extends('layouts.app')
@section('title', 'View Notes')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9">
                <div class="content">
                    <div id="head">
                        <h1 class="content-title font-size-24 pull-left">
                            Notes
                        </h1>
                        <a class="btn btn-dark pull-right" href="#">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="my-20">
                       <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <tbody>
                                        @if ($userNotes->count() == 0)
                                            <tr>
                                                <td class="text-center">You have no notes against {{ $company->get('company_name') }}.</td>
                                            </tr>
                                        @else
                                            @foreach ($userNotes as $note)
                                                <tr data-id="{{ $note->id }}">
                                                    <td id="note">{{ $note->note }}</td>
                                                    <td class="text-right action-btns">
                                                        <a class="btn btn-dark edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('company.notes.delete', ['company_id' => $company->get('company_number'), 'note_id' => $note->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <!-- publicly available notes cs -->
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
            $(".edit").click((e) => {
                const closestTr = $(e.target).closest('tr');
                const noteId    = closestTr.attr('data-id');
                const note      = closestTr.find('#note').text();

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
                        closestTr.find('#note').html(note);
                        return;
                    }

                    const route = "{{ route('company.notes.update', ['company_id' => ':comp_id', 'note_id' => ':note']) }}"
                        .replace(':comp_id', "{{ $company->get('company_number') }}")
                        .replace(':note', noteId);

                    $.ajax({
                        url: route,
                        method: 'PUT',
                        data: {
                            note: newNote,
                        },
                        success: (data) => {
                            console.log(data);
                            if (data.success) {
                                closestTr.find('#note').html(newNote);
                            }

                            toastr[data.success ? 'success' : 'error'](data.message);
                        }
                    });
                });
            });
        });
    </script>
@endsection
