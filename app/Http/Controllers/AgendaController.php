<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
