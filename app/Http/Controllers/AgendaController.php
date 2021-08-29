<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'nullable|max:20',
            'email' => 'nullable',
            'email' => 'nullable',
            'zip_code' => 'nullable|max:9',
            'addr_number' => 'nullable',
            'address' => 'nullable',
            'complement' => 'nullable',
            'uf' => 'nullable',
            'district' => 'nullable',
            'city' => 'nullable',
            'img_name' => 'nullable',
            'img_path' => 'nullable',
        ]);

        if ($request->hasFile('img_user')) {
            $imgUser = $request->file('img_user');
            $imageName = Str::random(15) . '.' . $imgUser->getClientOriginalExtension();
            $imgUser->move(public_path('images'), $imageName);
            $validatedData['img_name'] = $imageName;
            $validatedData['img_path'] = 'images/' . $imageName;
        }

        Contact::create($validatedData);

        return response()->json(['Sucesso' => 'Contato salvo!']);
    }

    public function edit($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // $contact = Contact::findOrFail($id);

    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        File::exists($contact->img_path) ? File::delete($contact->img_path) : '';
        $contact->delete();
        return response()->json(['Success' => 'Contato excluído com sucesso!']);
    }
}
