<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    public function __invoke(Request $request)
    {
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        return view('client.profile.edit', compact('client'));
    }

    public function edit(Request $request)
    {
        if (!isset($request->full_name)){
            return redirect()->back();
        }
        if (!isset($request->phone)){
            return redirect()->back();
        }
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);
        $client->full_name = $request->full_name;
        $client->phone = $request->phone;

        if ($request->hasFile('avatar')){
            $file = $request->avatar;
            $fileName = time() . '-' . rand() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('avatars/' . $fileName, file_get_contents($file));
            $client->avatar = 'avatars/' . $fileName;
        }
        $client->save();
        return redirect()->route('profile');
    }
}
