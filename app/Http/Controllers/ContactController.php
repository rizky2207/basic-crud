<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Contact::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $btn = '<div class="btn-group" role="group">';
                    $btn .= '<a href="contact/' . $data->id . '/edit" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editContact">Edit</a>';
                    $btn .= '<button class="btn btn-sm btn-danger" type="button" onClick="deleteConfirm(' . $data->id . ')">Delete</button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('contact.index');
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required',
            'phone'  => 'required',
        ]);

        //save to DB
        $contact = Contact::create([
            'first_name'   => $request->first_name,
            'last_name'   => $request->last_name,
            'email'   => $request->email,
            'phone'   => $request->phone,
        ]);

        if ($contact) {
            //redirect dengan pesan sukses
            return redirect()->route('contact.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('contact.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * edit
     *
     * @param  mixed $product
     * @return void
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contact.edit', compact('contact'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'  => 'required',
            'phone'  => 'required',
        ]);

        // $contact->update([
        //     'first_name'   => $request->first_name,
        //     'last_name'   => $request->last_name,
        //     'email'   => $request->email,
        //     'phone'   => $request->phone,
        // ]);
        $contact->update($validatedData);


        if ($contact) {
            //redirect dengan pesan sukses
            return redirect()->route('contact.index')->with('success', 'Data berhasil diperbarui');
        } else {
            //redirect dengan pesan error
            return redirect()->route('contact.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */

    public function destroy(Contact $contact)
    {

        if ($contact) {
            $contact->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
