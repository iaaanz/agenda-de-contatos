<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AgendaController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function create()
    {
    }

    public function store()
    {
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
