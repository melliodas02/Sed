<?php

namespace App\Http\Controllers\Sed\Contracts;

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

class ContractsController extends Controller
{
    public function PurchaseAndSaleAgreement()
    {
        $data_title = DocCategory::find(14);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 14);
        $url = '';
        return view('sed.Contracts.index', compact('data_title', 'data', 'url'));
    }

    public function LeaseAgreement()
    {
        $data_title = DocCategory::find(15);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 15);
        $url = '';
        return view('sed.Contracts.index', compact('data_title', 'data', 'url'));
    }

    public function DeliveryContract()
    {
        $data_title = DocCategory::find(16);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 16);
        $url = '';
        return view('sed.Contracts.index', compact('data_title', 'data', 'url'));
    }

    public function ContractAgreement()
    {
        $data_title = DocCategory::find(17);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 17);
        $url = '';
        return view('sed.Contracts.index', compact('data_title', 'data', 'url'));
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

        return view('sed.Contracts.add', compact('organizations', 'users', 'category', 'doc_number'));
    }

    public function save(Request $request)
    {
        $file = $request->Document;
        $fileName = time() . "_" . $file->getClientOriginalName();
        $filePath = "/Contracts/" . date("Y") . "/" . date("m") . "/" . $fileName . "/" . $fileName;
        $dir = "/Contracts/" . date("Y") . "/" . date("m") . "/" . $fileName . "/";

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
        $doc_saved->Doc_Url = $filePath;
        $doc_saved->DocType = $file->extension();
        $doc_saved->save();

        $documents_save = new DocumentInDocsSaved;
        $documents_save->Document = $doc->id;
        $documents_save->DocsSaved = $doc_saved->id;
        $documents_save->save();

        $route = 'contracts.';
        switch ($request->Category) {
            case 14:
                $route .= 'PurchaseAndSaleAgreement';
                break;
            case 15:
                $route .= 'LeaseAgreement';
                break;
            case 16:
                $route .= 'DeliveryContract';
                break;
            case 17:
                $route .= 'ContractAgreement';
                break;
        }

        return redirect()->route($route);
    }

    public function edit($id)
    {
        $data = Document::find($id);
        $organizations = Organization::all();
        $users = User::all();
        return view('sed.Contracts.edit', compact('organizations', 'users', 'data'));
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

        $route = 'contracts.';
        switch ($doc->Category) {
            case 14:
                $route .= 'PurchaseAndSaleAgreement';
                break;
            case 15:
                $route .= 'LeaseAgreement';
                break;
            case 16:
                $route .= 'DeliveryContract';
                break;
            case 17:
                $route .= 'ContractAgreement';
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
        return redirect()->route('contracts.PurchaseAndSaleAgreement');
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
        $user = User::find($data->Signatory);
        $org = Organization::find($data->Sender);
        $docs = DocumentInDocsSaved::get()->where('Document', $data->id)->first();
        $doc = DocsSaved::find($docs->DocsSaved);
        $content = Storage::disk('public')->get($doc->Doc_Url);
        return view('sed.Contracts.info', compact('data', 'content', 'user', 'org', 'doc'));
    }
}
