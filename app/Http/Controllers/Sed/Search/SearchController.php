<?php

namespace App\Http\Controllers\Sed\Search;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($search)
    {
        $search = str_replace('-',' ', $search);
        $data = Document::where('doc_number', 'like', '%'.$search.'%')->orWhere('title', 'like', '%'.$search.'%')->orWhere('Description', 'like', '%'.$search.'%')->get();
        $url = 'CorrespondenceWithStateAuthoritiesOutput';
        return view('sed.search.search', compact('data', 'url'));
    }
}
