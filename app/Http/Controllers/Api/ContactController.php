<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\ContactCreateRequest;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contact = Contact::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Customers',
            'contact'    => $contact
        ]);
    }

    public function show(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Data Customer tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Customer ditemukan',
            'contact' => $contact,
        ], 200);
    }


    public function store(Request $request)
    {
        $contact = Contact::create([
            'first_name'   => $request->first_name,
            'last_name'   => $request->last_name,
            'email'   => $request->email,
            'phone'   => $request->phone,
        ]);
        return response()->json([
            'success'       => true,
            'message'       => 'Berhasil Ditambahkan',
            'contact'    => $contact
        ]);
    }



    public function update(Request $request, Contact $contact, $id)
    {
        $this->validate($request, [
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required',
            'phone'  => 'required',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update([
            'first_name'   => $request->first_name,
            'last_name'   => $request->last_name,
            'email'   => $request->email,
            'phone'   => $request->phone,
        ]);

        return response()->json([
            'success'       => true,
            'message'       => 'data berhasil Di Update',
            'contact'    => $contact
        ]);
    }


    public function destroy($id)
    {

        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Data not found'
                ]
            ])->setStatusCode(404);
        }

        $contact->delete();
        return response()->json([
            'data' => true,
            'message'       => 'data berhasil Di Hapus',
        ])->setStatusCode(200);
    }
}
