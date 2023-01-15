<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Note;
use App\Enums\Company\Notes\ViewPreference;
use Illuminate\Http\Request;
use Jay\CHouse\CompaniesHouse;

class CompanyController extends Controller
{
    /**
     * The Companies House API client
     *
     * @var \Jay\CHouse\CompaniesHouse
     */
    public CompaniesHouse $client;

    /**
     * Construct a new CompanyController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new CompaniesHouse(env('CHOUSE_API_KEY'));
    }

    /**
     * Show the company page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, string $companyId)
    {
        $company = $this->client->fromCompanyID($companyId);

        return view('company.index', compact('company'));
    }

    /**
     * Show the company officers page
     *
     * @param   Request  $request      The request object
     * @param   string   $companyId    The company ID
     *
     * @return \Illuminate\View\View
     */
    public function officers(Request $request, string $companyId)
    {
        $company  = $this->client->fromCompanyID($companyId);
        $officers = collect($company->get('officers')['items'])->map(function ($officer) {
            return collect($officer);
        });;

        return view('company.officers', compact('company', 'officers'));
    }

    /**
     * Show the company previous names page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function previousNames(Request $request, string $companyId)
    {
        $company       = $this->client->fromCompanyID($companyId);
        $previousNames = collect($company->get('previous_company_names'))->map(function ($officer) {
            return collect($officer);
        });

        return view('company.previous-names', compact('company', 'previousNames'));
    }

    /**
     * Show the company notes page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function notes(Request $request, string $companyId)
    {
        $company      = $this->client->fromCompanyID($companyId);
        $userNotes    = Note::where('company_id', $companyId)
                            ->where('user_id', $request->user()->id)
                            ->where('is_archived', false)
                            ->get();

        return view('company.notes', compact('company', 'userNotes'));
    }

    /**
     * Delete a note
     *
     * @param   Request  Request     The request object
     * @param   string   $companyId  The company ID
     * @param   string   $noteId     The note ID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteNote(Request $request, string $companyId, string $noteId)
    {
        $note    = Note::where('company_id', $companyId)
                    ->where('user_id', $request->user()->id)
                    ->where('id', $noteId)
                    ->first();

        if (!$note) {
            return redirect()->back()->with('error', 'Note not found');
        }

        try {
            $note->update(['is_archived' => true]);
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Failed to delete note');
        }

        return redirect()->back()->with('success', 'Note deleted');
    }

    /**
     * Update a note (AJAX)
     *
     * @param   Request   $request    The request object
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNote(Request $request, string $companyId, string $noteId)
    {
        $newNote = $request->input('note');
        $note    = Note::where('company_id', $companyId)
                    ->where('user_id', $request->user()->id)
                    ->where('id', $noteId)
                    ->first();

        if (!$note) {
            return response()->json([
                'success' => false,
                'message' => 'Note not found'
            ]);
        }

        try {
            $note->update(['note' => $newNote]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update note'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Note updated'
        ]);
    }
}
