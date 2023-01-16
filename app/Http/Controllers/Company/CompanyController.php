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
        $company           = $this->client->fromCompanyID($companyId);
        $registeredAddress = collect($company->get('registered_office_address'));

        return view('company.index', compact('company', 'registeredAddress'));
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

    public function filingHistory(Request $request, string $companyId)
    {
        $company       = $this->client->fromCompanyID($companyId);
        $filingHistory = collect($company->get('filing_history')['items'])->map(function ($officer) {
            return collect($officer);
        });

        return view('company.filing-history', compact('company', 'filingHistory'));
    }

    /**
     * Show the company accounts page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function accounts(Request $request, string $companyId)
    {
        $company       = $this->client->fromCompanyID($companyId);
        $accounts      = collect($company->get('accounts'))->map(function ($officer) {
            return collect($officer);
        });
        $confirmation  = collect($company->get('confirmation_statement'));

        return view('company.accounts', compact('company', 'accounts', 'confirmation'));
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
     * Show the company archived notes page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function archivedNotes(Request $request, string $companyId)
    {
        $company      = $this->client->fromCompanyID($companyId);
        $userNotes    = Note::where('company_id', $companyId)
                            ->where('user_id', $request->user()->id)
                            ->where('is_archived', true)
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
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Restore a note
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     * @param   string   $noteId     The note ID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreNote(Request $request, string $companyId, string $noteId)
    {
        $note = Note::where('company_id', $companyId)
                    ->where('user_id', $request->user()->id)
                    ->where('id', $noteId)
                    ->first();

        if (!$note) {
            return redirect()->back()->with('error', 'Note not found');
        }

        try {
            $note->update(['is_archived' => false]);
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Failed to restore note');
        }

        return redirect()->back()->with('success', 'Note restored');
    }

    /**
     * Add a note (AJAX)
     *
     * @param   Request   $request    The request object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNote(Request $request, string $companyId)
    {
        try {
            $note = Note::create([
                'company_id' => $companyId, 
                'user_id'    => $request->user()->id,
                'note'       => $request->input('note')
            ]);    
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to add note'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Note added',
            'noteId'  => $note->id
        ]);
    }
}
