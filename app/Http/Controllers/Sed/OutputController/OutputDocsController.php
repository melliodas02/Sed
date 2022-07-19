<?php

namespace App\Http\Controllers\Sed\OutputController;

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
use function PHPUnit\Framework\returnArgument;

class OutputDocsController extends Controller
{
    public function CorrespondenceWithStateAuthoritiesOutput()
    {
        $data_title = DocCategory::find(4);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 4);
        $url = 'CorrespondenceWithStateAuthoritiesOutput';
        return view('sed.OutputDocs.index', compact('data', 'data_title', 'url'));
    }

    public function CorrespondenceWithOrganizationsAndEnterprisesOutput()
    {
        $data_title = DocCategory::find(5);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 5);
        $url = 'CorrespondenceWithOrganizationsAndEnterprisesOutput';
        return view('sed.OutputDocs.index', compact('data', 'data_title', 'url'));
    }

    public function DocumentsFromAHigherLevelOrganizationsOutput()
    {
        $data_title = DocCategory::find(6);
        $data_title = $data_title->title;
        $data = Document::get()->where('Category', 6);
        $url = 'DocumentsFromAHigherLevelOrganizationsOutput';
        return view('sed.OutputDocs.index', compact('data', 'data_title', 'url'));
    }

    public function add()
    {
        $organizations = Organization::all();
        $users = User::all();
        $category = DocCategory::all()->where('docType', 2);

        $last = Document::orderBy('created_at', 'desc')->first();

        if ($last == null)
        {
            $number = 1;
        } else {
            $number = $last->id + 1;
        }

        $doc_number = date('Y') . date('m') . '-' . $number;

        return view('sed.OutputDocs.add', compact('organizations', 'users', 'category', 'doc_number'));
    }

    public function save(Request $request)
    {
        $file = $request->Document;
        $fileName = time()."_".$file->getClientOriginalName();
        $filePath = "/OutputDocs/".date("Y")."/".date("m")."/".$fileName."/".$fileName;
        $dir = "/OutputDocs/".date("Y")."/".date("m")."/".$fileName."/";

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

        $route = '';
        switch ($request->Category) {
            case 4:
                $route = 'correspondence_with_state_authorities';
                break;
            case 5:
                $route = 'correspondence_with_organizations_and_enterprises';
                break;
            case 6:
                $route = 'documents_from_a_higher_level_organizations';
                break;
        }
        $route .= '.index';

        return redirect()->route($route);
    }

    public function edit($id)
    {
        $data = Document::find($id);
        $organizations = Organization::all();
        $users = User::all();
        return view('sed.InputDocs.edit', compact('organizations', 'users', 'data'));
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
        $route = '';
        switch ($doc->Category) {
            case 4:
                $route = 'correspondence_with_state_authorities';
                break;
            case 5:
                $route = 'correspondence_with_organizations_and_enterprises';
                break;
            case 6:
                $route = 'documents_from_a_higher_level_organizations';
                break;
        }
        $route .= '.index';

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
        return redirect()->route('correspondence_with_organizations_and_enterprises.index');
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
        return view('sed.OutputDocs.info', compact('data', 'user', 'org', 'content', 'doc'));
    }
}
