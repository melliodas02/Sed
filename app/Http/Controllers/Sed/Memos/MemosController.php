<?php

namespace App\Http\Controllers\Sed\Memos;

use App\Http\Controllers\Controller;
use App\Models\DocCategory;
use App\Models\DocsSaved;
use App\Models\Document;
use App\Models\DocumentInDocsSaved;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MemosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:docs-list|docs-create|docs-edit|docs-delete', ['only' => [
            'AboutEmployeeBusinessTrips',
            'AboutTheDevelopmentAndChangeOfStaffSchedules',
            'ForPurchase',
            'AboutReimbursementOfExpenses',
            'save'
        ]]);
        $this->middleware('permission:docs-create', ['only' => ['add', 'save']]);
        $this->middleware('permission:docs-edit', ['only' => ['edit', 'put']]);
        $this->middleware('permission:docs-delete', ['only' => ['delete']]);
    }

    public function AboutEmployeeBusinessTrips()
    {
        $data_title = DocCategory::find(10);
        $data_title = $data_title->title;
        if (auth()->user()->hasRole('Администратор-делопроизводитель'))
        {
            $data = Document::get()->where('Category', 10);
        } else {
            $data = Document::get()->where('Category', 10)->where('Sender', auth()->user()->id);
        }
        $url = 'AboutEmployeeBusinessTrips';
        return view('sed.Memos.index', compact('data', 'data_title', 'url'));
    }

    public function AboutTheDevelopmentAndChangeOfStaffSchedules()
    {
        $data_title = DocCategory::find(11);
        $data_title = $data_title->title;
        if (auth()->user()->hasRole('Администратор-делопроизводитель'))
        {
            $data = Document::get()->where('Category', 11);
        } else {
            $data = Document::get()->where('Category', 11)->where('Sender', auth()->user()->id);
        }
        $url = 'AboutTheDevelopmentAndChangeOfStaffSchedules';
        return view('sed.Memos.index', compact('data', 'data_title', 'url'));
    }

    public function ForPurchase()
    {
        $data_title = DocCategory::find(12);
        $data_title = $data_title->title;
        if (auth()->user()->hasRole('Администратор-делопроизводитель'))
        {
            $data = Document::get()->where('Category', 12);
        } else {
            $data = Document::get()->where('Category', 12)->where('Sender', auth()->user()->id);
        }
        $url = 'ForPurchase';
        return view('sed.Memos.index', compact('data', 'data_title', 'url'));
    }

    public function AboutReimbursementOfExpenses()
    {
        $data_title = DocCategory::find(13);
        $data_title = $data_title->title;
        if (auth()->user()->hasRole('Администратор-делопроизводитель'))
        {
            $data = Document::get()->where('Category', 13);
        } else {
            $data = Document::get()->where('Category', 13)->where('Sender', auth()->user()->id);
        }
        $url = 'AboutReimbursementOfExpenses';
        return view('sed.Memos.index', compact('data', 'data_title', 'url'));
    }

    public function add()
    {
        $organizations = Organization::all();
        $users = User::all();
        $category = DocCategory::all()->where('docType', 4);

        $last = Document::orderBy('created_at', 'desc')->first();

        if ($last == null)
        {
            $number = 1;
        } else {
            $number = $last->id + 1;
        }

        $doc_number = date('Y') . date('m') . '-' . $number;

        return view('sed.Memos.add', compact('organizations', 'users', 'category', 'doc_number'));
    }

    public function save(Request $request)
    {
        $file = $request->Document;
        $fileName = time()."_".$file->getClientOriginalName();
        $filePath = "/Memos/".date("Y")."/".date("m")."/".$fileName."/".$fileName;
        $dir = "/Memos/".date("Y")."/".date("m")."/".$fileName."/";

        $file->storeAs($dir, $fileName, 'public');

        $doc = new Document;

        $doc->title = $request->title;
        $doc->doc_number = $request->doc_number;
        $doc->Description = $request->description;
        $doc->Date = $request->Date;
        $doc->Category = $request->Category;
        $doc->Signatory = $request->Signatory;
        $doc->Sender = $request->Sender;

        $doc->save();

        $doc_saved = new DocsSaved;
        $doc_saved->name = $fileName;
        $doc_saved->Doc_Url  = $filePath;
        $doc_saved->DocType = $file->extension();
        $doc_saved->save();

        $documents_save = new DocumentInDocsSaved;
        $documents_save->Document = $doc->id;
        $documents_save->DocsSaved = $doc_saved->id;
        $documents_save->save();

        $route = 'memos.';
        switch ($request->Category) {
            case 10:
                $route .= 'AboutEmployeeBusinessTrips';
                break;
            case 11:
                $route .= 'AboutTheDevelopmentAndChangeOfStaffSchedules';
                break;
            case 12:
                $route .= 'ForPurchase';
                break;
            case 13:
                $route .= 'AboutReimbursementOfExpenses';
                break;
        }

        return redirect()->route($route);
    }

    public function edit($id)
    {
        $data = Document::find($id);
        $organizations = Organization::all();
        $users = User::all();
        return view('sed.Memos.edit', compact('organizations', 'users', 'data'));
    }

    public function put(Request $request, $id)
    {
        $doc = Document::find($id);

        $doc->title = $request->title;
        $doc->Description = $request->description;
        $doc->Date = $request->Date;
        $doc->Signatory = $request->Signatory;
        $doc->Sender = $request->Sender;

        $doc->save();

        $route = 'memos.';
        switch ($doc->Category) {
            case 10:
                $route .= 'AboutEmployeeBusinessTrips';
                break;
            case 11:
                $route .= 'AboutTheDevelopmentAndChangeOfStaffSchedules';
                break;
            case 12:
                $route .= 'ForPurchase';
                break;
            case 13:
                $route .= 'AboutReimbursementOfExpenses';
                break;
        }

        return redirect()->route($route);
    }

    public function delete($id)
    {
        $data = Document::find($id);
        $docs = DocumentInDocsSaved::get()->where('Document', $data->id)->first();
        $doc = DocsSaved::find($docs->DocsSaved);
        Storage::delete($doc->Doc_Url);
        $doc->delete();
        $docs->delete();
        $data->delete();
        return redirect()->route('memos.AboutEmployeeBusinessTrips');
    }

    public function download($id)
    {
        $data = DocsSaved::find($id);
        $content_type = 'application/';
        switch ($data->DocType) {
            case 'pdf':
                $content_type .= 'pdf';
                break;
            case 'doc':
                $content_type .= 'msword';
                break;
            case 'docx':
                $content_type .= 'vnd.openxmlformats-officedocument.wordprocessingml.document';
                break;
            case 'txt':
                $content_type = 'text/plain';
                break;
            case 'odt':
                $content_type .= 'vnd.oasis.opendocument.text';
        }
        $files = Storage::disk('public')->get($data->Doc_Url);
        return (new Response($files, 200))->header('Content-Type', $content_type);
    }

    public function info($id)
    {
        $data = Document::find($id);
        $user = User::find($data->Sender);
        $org = Organization::find($data->Signatory);
        $docs = DocumentInDocsSaved::get()->where('Document', $data->id)->first();
        $doc = DocsSaved::find($docs->DocsSaved);
        $content = Storage::disk('public')->get($doc->Doc_Url);
        return view('sed.Memos.info', compact('data', 'content', 'user', 'org', 'doc'));
    }
}
