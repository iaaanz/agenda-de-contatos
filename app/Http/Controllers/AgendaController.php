<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
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

    public function store(StoreContactRequest $request)
    {
        $validatedData = $request->validated();

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

    public function update(StoreContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validated();

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
