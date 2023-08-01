<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\Likes;
use App\Models\Questions;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller{

    public function __invoke(Request $request){
        if(!isset($request->text)){
            return redirect()->back()->withErrors('متن سوال رو وارد کنید', 'question');
        }
        Questions::query()->create([
            "text" => $request->text,
            "product_id" => $request->product_id,
            "client_id" => auth()->guard('clients')->user()->id,
            "likes" => 0,
            "dis_likes" => 0,
        ]);
        return redirect(url()->previous());

    }

    public function reply(Request $request, $q_id){
        if(!isset($request->text)){
            return redirect()->back();
        }
        if(!auth()->guard('web')->check()){
            return redirect()->back();
        }
        Questions::query()->create([
            "text" => $request->text,
            "product_id" => $request->product_id,
            "client_id" => 0,
            "likes" => 0,
            "dis_likes" => 0,
            'reply_to' => $q_id,
        ]);
        return redirect()->back();

    }

    public function like($q_id){
        $question = Questions::query()->findOrFail($q_id);
        $like = Likes::query()->where([
            'client_id' => auth()->guard('clients')->user()->id,
            "question_id" => $q_id,
        ])->first();
        if($like){

            if($like->is_like){
                $question->likes -= 1;
                $like->delete();
            } else {
                $question->likes += 1;
                $question->dis_likes -= 1;
                $like->delete();
                $like = Likes::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    "question_id" => $q_id,
                    "is_like" => true,
                ]);
            }

        } else {
            $question->likes += 1;
            $like = Likes::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                "question_id" => $q_id,
                "is_like" => true,
            ]);
        }
        $question->save();
        return redirect(url()->previous());
    }

    public function dis_like($q_id){
        $question = Questions::query()->findOrFail($q_id);
        $like = Likes::query()->where([
            'client_id' => auth()->guard('clients')->user()->id,
            "question_id" => $q_id,
        ])->first();

        if($like){

            if($like->is_like){
                $question->likes -= 1;
                $like->delete();
                $like = Likes::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    "question_id" => $q_id,
                    "is_like" => false,
                ]);
                $question->dis_likes += 1;
            } else {
                $question->dis_likes -= 1;
                $like->delete();
            }

        } else {
            $question->dis_likes += 1;
            $like = Likes::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                "question_id" => $q_id,
                "is_like" => false,
            ]);
        }
        $question->save();
        return redirect(url()->previous());
    }

    public function store_admin(Request $request){
        Validator::make($request->all(), [
            'text' => ['required', 'string'],
            'client_id' => ['required', 'exists:clients,id'],
        ])->validate();

        $client_id = $request->client_id;

        $support = Questions::query()->create([
            'client_id' => $client_id,
            'is_admin' => true,
            'text' => $request->text,
            'reply_to' => $request->id,
            'is_active' => true,
        ]);

        return _response("ok");
    }

}
