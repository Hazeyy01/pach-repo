<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemadmin;
use App\Models\Systemparent;
use App\Models\SigninResponse;

class UserController extends Controller
{
    public function signinOfficer(Request $request)
    {
        $signinResponse = new SigninResponse();
        $existingOfficer = Systemadmin::where('admin_email', '=', $request -> input('officer_email')) -> first();

        if(!empty($existingOfficer)) {
            if ($existingOfficer -> admin_approval_status == 1) {
                if (strcmp($existingOfficer -> admin_password, $request -> input('officer_password')) == 0) {
                    $signinResponse -> user_id = $existingOfficer -> admin_id;
                    $signinResponse -> user_type = $existingOfficer -> admin_type;
                    $signinResponse -> response_status = true;
                } else {
                    $signinResponse -> response_status = false;
                    $signinResponse -> response_message = 'Failed! Wrong password.';
                }
            } else {
                $signinResponse -> response_status = false;
                $signinResponse -> response_message = 'Failed! Not approve.';
            }
        } else {
            $signinResponse -> response_status = false;
            $signinResponse -> response_message = 'Failed! Not registered.';
        }

        return response() -> json(array('response' => $signinResponse), 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexOfficer()
    {
        $admins = Systemadmin::all();
        return response() -> json(array('admins' => $admins), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOfficer(Request $request)
    {
        $createdOfficer = Systemadmin::create([
            'admin_id' => Str::uuid() -> toString(),
            'admin_name' => $request -> input('officer_name'),
            'admin_email' => $request -> input('officer_email'),
            'admin_password' => $request -> input('officer_password'),
            'admin_type' => "ADMIN",
            'admin_approval_status' => 2
        ]);

        return response() -> json(array('officer' => $createdOfficer), 200);
    }

    /**
     * Display the specified resource.
     */
    public function showOfficer(string $id)
    {
        $admin = Systemadmin::find($id);

        $officer = new Systemadmin();
        $officer -> officer_id = $admin -> admin_id;
        $officer -> officer_name = $admin -> admin_name;
        $officer -> officer_email = $admin -> admin_email;
        $officer -> officer_password = $admin -> admin_password;

        return response() -> json(array('officer' => $officer), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOfficer(Request $request)
    {
        $existadmin = Systemadmin::find($request -> input('officer_id'));
        if (!empty($existadmin)) {
            $existadmin -> admin_id = $request -> officer_id;
            $existadmin -> admin_name = $request -> officer_name;
            $existadmin -> admin_email = $request -> officer_email;
            $existadmin -> admin_password = $request -> officer_password;

            $updateOfficer = $existadmin -> save();
        }

        return response() -> json(array('officer' => $updateOfficer), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOfficerStatus(Request $request)
    {
        $existadmin = Systemadmin::find($request -> officer_id);
        if (!empty($existadmin)) {
            $existadmin -> admin_id = $request -> officer_id;
            $existadmin -> admin_approval_status = $request -> officer_approval_status;

            $updateOfficer = $existadmin -> save();
        }

        return response() -> json(array('officer' => $updateOfficer), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOfficer(string $id)
    {
        $deleteStatus = false;
        $officer = Systemadmin::find($id);

        if (!empty($officer)) {
            $deleteStatus = $officer -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }

    public function signinParent(Request $request)
    {
        $signinResponse = new SigninResponse();
        $existingParent = SystemParent::where('parent_email', '=', $request -> input('parent_email')) -> first();

        if(!empty($existingParent)) {
            if (strcmp($existingParent -> parent_password, $request -> input('parent_password')) == 0) {
                $signinResponse -> user_id = $existingParent -> parent_id;
                $signinResponse -> user_type = 'PARENT';
                $signinResponse -> response_status = true;
            } else {
                $signinResponse -> response_status = false;
                $signinResponse -> response_message = 'Failed! Wrong password.';
            }
        } else {
            $signinResponse -> response_status = false;
            $signinResponse -> response_message = 'Failed! Not registered.';
        }

        return response() -> json(array('response' => $signinResponse), 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexParent()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeParent(Request $request)
    {
        $createdParent = Systemparent::create([
            'parent_id' => Str::uuid() -> toString(),
            'parent_name' => $request -> input('parent_name'),
            'parent_email' => $request -> input('parent_email'),
            'parent_password' => $request -> input('parent_password')
        ]);

        return response() -> json(array('parent' => $createdParent), 200);
    }

    /**
     * Display the specified resource.
     */
    public function showParent(string $id)
    {
        $parent = Systemparent::find($id);
        return response() -> json(array('parent' => $parent), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateParent(Request $request)
    {
        $parent = Systemparent::find($request -> input('parent_id'));
        $updateParent = $parent -> update($request -> all());
        return response() -> json(array('parent' => $updateParent), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyParent(string $id)
    {
        $deleteStatus = false;
        $parent = Systemparent::find($id);

        if (!empty($parent)) {
            $deleteStatus = $parent -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
