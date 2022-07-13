<?php

namespace App\Http\Controllers\Sed\Mails;

use App\Http\Controllers\Controller;
use App\Models\DocCategory;
use App\Models\DocsSaved;
use App\Models\DocType;
use App\Models\Document;
use App\Models\DocumentInDocsSaved;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Webklex\IMAP\Facades\Client;
use App\Models\Mail;
use App\Models\MailDoc;
use App\Models\MailDocsTable;
use Illuminate\Support\Facades\File;

/**
 * 'G7QJmPJYgmOkyhO87BXX',
 */

class MailController extends Controller
{
    public function index()
    {
        $messages = Mail::all();

        return view('sed.Mails.index', compact('messages'));
    }

    public function update()
    {
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->query()->unseen()->get();

        foreach ($messages as $k => $m) {
            $isset = false;
            $model = Mail::all()->where('From', $m->getFrom()[0]->mail);
            foreach ($model as $obj)
            {
                if ($obj->Subject == $m->getSubject() && $obj->Body == $m->getTextBody())
                {
                    $isset = true;
                }
            }
            if (!$isset)
            {
                $mail = new Mail;
                $mail->From = $m->getFrom()[0]->mail;
                $mail->Subject = $m->getSubject();
                $mail->Body = $m->getTextBody();
                $mail->Count = $m->getAttachments()->count();
                $mail->save();

                $aa = $m->getAttachments();
                foreach ($aa as $a)
                {
                    $dir = storage_path()."/app/public/Mails/".date("Y")."/".date("m")."/".$m->getSubject()."/".$a->name."/";
                    $file = "/Mails/".date("Y")."/".date("m")."/".$m->getSubject()."/".$a->name."/".$a->name;
                    $file_dir = "/public/Mails/".date("Y")."/".date("m")."/".$m->getSubject()."/".$a->name;

                    Storage::makeDirectory($file_dir);

                    $doc = new MailDoc;
                    $doc->name = $a->name;
                    $doc->Doc_Url = $file;
                    $doc->save();

                    $md = new MailDocsTable;
                    $md->Mail = $mail->id;
                    $md->MailDoc = $doc->id;
                    $md->save();

                    $a->save($dir);
                }
            }
        }
        return redirect()->route('mails.index')->with('success', 'Обновление успешно');
    }

    public function info($id)
    {
        $mail = Mail::find($id);
        $mail_docs = MailDocsTable::get()->where('Mail', $id);
        $docs = [];
        foreach ($mail_docs as $md)
        {
            array_push($docs, MailDoc::find($md->MailDoc));
        }
        return view('sed.Mails.info', compact('mail_docs','mail', 'docs'));
    }

    public function download($id)
    {
        $mail = MailDoc::find($id);
        $ext = explode('.', $mail->name)[1];
        $content_type = 'application/';
        switch ($ext)
        {
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
        $files = Storage::disk('public')->get($mail->Doc_Url);
        return (new Response($files, 200))->header('Content-Type', $content_type);
    }

    public function pushInDocs($id)
    {
        $mail = Mail::find($id);
        $mail_docs = MailDocsTable::get()->where('MailDoc', $id);
        $docTypes = DocType::all();
        $docCategories = DocCategory::all();
        $organizations = Organization::all();
        $users = User::all();
        return view('sed.Mails.pushInDocs', compact('mail', 'docCategories', 'docTypes', 'organizations', 'users', 'mail_docs'));
    }

    public function save_documents(Request $request)
    {
        $last = Document::get()->whereIn('Category', [1,2,3]);
        $number = count($last) + 1;
        $doc_number = date('Y').date('m').$number;

        $doc = new Document;
        $doc->title = $request->title;
        $doc->doc_number = $doc_number;
        $doc->Description = $request->description;
        $doc->Date = $request->Date;
        $doc->Category = $request->Category;
        $doc->Signatory = $request->Signatory;
        $doc->Sender = $request->Sender;
        $doc->save();

        foreach ($request->docs as $docs)
        {
            $mail = MailDoc::find($docs);
            $doc_saved = new DocsSaved;
            $doc_saved->name = $mail->name;
            $doc_saved->Doc_Url  = $mail->Doc_Url;
            $ext = explode('.', $mail->name)[1];
            $doc_saved->DocType = $ext;
            $doc_saved->save();

            $documents_save = new DocumentInDocsSaved;
            $documents_save->Document = $doc->id;
            $documents_save->DocsSaved = $doc_saved->id;
            $documents_save->save();
        }

        return redirect()->route('mails.index');
    }
}
