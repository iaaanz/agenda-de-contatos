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
            'name' => 'required|max:50',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|max:40',
            'zip_code' => 'nullable|max:9',
            'addr_number' => 'nullable|max:20',
            'address' => 'nullable|max:100',
            'complement' => 'nullable|max:50',
            'uf' => 'nullable|max:2',
            'district' => 'nullable|max:50',
            'city' => 'nullable|max:50',
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

        return response()->json(['Success' => 'Contato salvo!']);
    }

    public function edit($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|max:40',
            'zip_code' => 'nullable|max:9',
            'addr_number' => 'nullable|max:20',
            'address' => 'nullable|max:100',
            'complement' => 'nullable|max:50',
            'uf' => 'nullable|max:2',
            'district' => 'nullable|max:50',
            'city' => 'nullable|max:50',
            'img_name' => 'nullable',
            'img_path' => 'nullable',
        ]);

        if (!$contact->img_path && $request->hasFile('img_user')) {
            $imgUser = $request->file('img_user');
            $imageName = Str::random(15) . '.' . $imgUser->getClientOriginalExtension();
            $imgUser->move(public_path('images'), $imageName);
            $validatedData['img_name'] = $imageName;
            $validatedData['img_path'] = 'images/' . $imageName;
        } else if ($contact->img_path && $request->hasFile('img_user')) {
            File::exists($contact->img_path) ? File::delete($contact->img_path) : '';
            $imgUser = $request->file('img_user');
            $imageName = Str::random(15) . '.' . $imgUser->getClientOriginalExtension();
            $imgUser->move(public_path('images'), $imageName);
            $validatedData['img_name'] = $imageName;
            $validatedData['img_path'] = 'images/' . $imageName;
        } else if ($contact->img_path && !$request->hasFile('img_user')) {
            if ($contact->img_path !== $request->get('img_user')) {
                File::exists($contact->img_path) ? File::delete($contact->img_path) : '';
                $validatedData['img_name'] = '';
                $validatedData['img_path'] = '';
            };
        }

        $contact->update($validatedData);

        return response()->json(['Success' => 'Contato salvo!']);
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        File::exists($contact->img_path) ? File::delete($contact->img_path) : '';
        $contact->delete();
        return response()->json(['Success' => 'Contato excluído!']);
    }
}
