<?php

namespace App\Http\Controllers\Sed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();

        return view('sed.organization.index', compact('organizations'));
    }

    public function add()
    {
        return view('sed.organization.add');
    }

    public function create(Request $request)
    {
        $org = new Organization;
        $org->OrganizationName = $request->OrganizationName;
        $org->OrganizationAbbreviatedName = $request->OrganizationAbbreviatedName;
        $org->OrganizationAddress = $request->OrganizationAddress;
        $org->INN = $request->INN;
        $org->PositionAtWork = $request->PositionAtWork;
        $org->FirstName = $request->FirstName;
        $org->MiddleName = $request->MiddleName;
        $org->LastName = $request->LastName;
        $org->Phone = $request->Phone;
        $org->Email = $request->Email;
        $org->Fax = $request->Fax;

        $org->save();

        return redirect()->route('organization.index');
    }

    public function show($id)
    {
        $data = Organization::find($id);
        return view('sed.organization.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Organization::find($id);
        return view('sed.organization.edit', compact('data'));
    }

    public function saveChanges(Request $request, $id)
    {
        $org = Organization::find($id);

        $org->OrganizationName = $request->OrganizationName;
        $org->OrganizationAbbreviatedName = $request->OrganizationAbbreviatedName;
        $org->OrganizationAddress = $request->OrganizationAddress;
        $org->PositionAtWork = $request->PositionAtWork;
        $org->INN = $request->INN;
        $org->FirstName = $request->FirstName;
        $org->MiddleName = $request->MiddleName;
        $org->LastName = $request->LastName;
        $org->Phone = $request->Phone;
        $org->Email = $request->Email;
        $org->Fax = $request->Fax;

        $org->save();

        return redirect()->route('organization.index');
    }

    public function remove($id)
    {
        $data = Organization::find($id);
        $data->delete();
        return redirect()->route('organization.index');
    }
}
