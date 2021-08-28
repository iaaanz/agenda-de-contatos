<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store(Request $request)
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
