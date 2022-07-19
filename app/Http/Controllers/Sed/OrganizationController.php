<?php

namespace App\Http\Controllers\Sed;

use App\Imports\OrganizationsImport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Maatwebsite\Excel\Excel;
use function Psy\debug;

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

    public function init_agents()
    {
        ini_set('memory_limit', '100M');
        $u = (new UsersImport)->toArray('init_files/123.xlsx', 'public');

        foreach($u[0] as $user)
        {
            $fio = explode(' ', $user[1]);
            if (User::where('LastName', '=', $fio[0])->count() == 0)
            {
                $us = new User;
                $us->LastName = $fio[0];
                $us->FirstName = $fio[1];
                if (isset($fio[2]))
                {
                    $us->MiddleName = $fio[2];
                }
                $bd = explode('.', $user[2]);
                $us->BirthDay = $bd[2].'-'.$bd[1].'-'.$bd[0];
                $us->save();
            }
        }

        $org = (new OrganizationsImport)->toArray('init_files/Org.xlsx', 'public');
        $org = $org[0];

        foreach ($org as $o)
        {
            if (strlen($o[1]) == 10)
            {
                if (Organization::where('INN', '=', $o[1])->count() == 0) {
                    $token = "f904fe93299d45f292cbc9191cf90d9ce97b7ce0";
                    $dadata = new \Dadata\DadataClient($token, null);
                    $result = $dadata->suggest("party", $o[1]);
                    $organization = new Organization;
                    $organization->OrganizationName = $result[0]['data']['name']['full_with_opf'];
                    if(isset($result[0]['data']['name']['short_with_opf']))
                    {
                        $organization->OrganizationAbbreviatedName = $result[0]['data']['name']['short_with_opf'];
                    } else {
                        $organization->OrganizationAbbreviatedName = $result[0]['data']['name']['full_with_opf'];
                    }
                    $organization->OrganizationAddress = $result[0]['data']['address']['unrestricted_value'];
                    $organization->PositionAtWork = $result[0]['data']['management']['post'];
                    $organization->INN = $o[0];
                    $fio = explode(' ', $result[0]['data']['management']['name']);
                    $organization->LastName = $fio[0];
                    $organization->FirstName = $fio[0];
                    $organization->MiddleName = $fio[0];
                    $organization->save();
                }
            }
        }
    }
}
