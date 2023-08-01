<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class FilesController extends Controller
{

    public function __invoke(Request $request)
    {
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.files', compact('client'));

    }
}
