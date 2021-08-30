<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store(StoreContactRequest $request)
    {
        $validatedData = $request->validated();
        $requestImg = $request->hasFile('img_user');

        if ($requestImg) {
            $requestImg = $request->file('img_user');
            $validatedData = setNewUserImg($requestImg, $validatedData);
        }

        Contact::create($validatedData);

        return response()->json(['Success' => 'Contato salvo!']);
    }

    public function edit($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(StoreContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $validatedData = $request->validated();
        $requestImg = $request->hasFile('img_user');

        if (!$contact->img_path && $requestImg) {
            $requestImg = $request->file('img_user');
            $validatedData = setNewUserImg($requestImg, $validatedData);
        } else if ($contact->img_path && $requestImg) {
            File::exists($contact->img_path) ? File::delete($contact->img_path) : '';
            $requestImg = $request->file('img_user');
            $validatedData = setNewUserImg($requestImg, $validatedData);
        } else if ($contact->img_path && !$requestImg) {
            if ($contact->img_path !== $request->get('img_user')) {
                $validatedData = delUserImg($contact->img_path, $validatedData);
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
