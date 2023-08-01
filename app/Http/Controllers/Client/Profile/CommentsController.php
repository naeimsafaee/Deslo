<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $client = auth()->guard('clients')->user();
        $comments = $client->comments;

        return view('client.profile.comments' , compact('comments' , 'client'));
    }
}
