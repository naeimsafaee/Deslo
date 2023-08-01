<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\commentFeature;
use App\Models\commentFile;
use App\Models\CommentProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentRelplyController extends Controller{

    public function __invoke(Request $request, $id){
        $product = Product::query()->findOrFail($id);
        return view('client.product.comment_reply', compact('product'));
    }

    public function submit(Request $request){
        $comment = CommentProduct::query()->create([
            "text" => $request->textComment,
            "product_id" => $request->product_id,
            "client_id" => auth()->guard('clients')->user()->id,
            "rate" => $request->ratingNo,
            "offer" => $request->offer,
            "is_active" => false,
        ]);

        $greens = explode("-", $request->greenItems);
        $reds = explode("-", $request->redItems);

        foreach($greens as $green){
            if(!$green)
                continue;
            commentFeature::query()->create([
                "comment_id" => $comment->id,
                "text" => $green,
                "is_positive" => true,
            ]);
        }

        foreach($reds as $red){
            if(!$red)
                continue;
            commentFeature::query()->create([
                "comment_id" => $comment->id,
                "text" => $red,
                "is_positive" => false,
            ]);
        }


        if($request->has("files")){
            foreach($request->file("files") as $file){

                $fileName = time() . '-' . rand() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('files/' . $fileName, file_get_contents($file));

                commentFile::query()->create([
                    "file" => "files/" . $fileName,
                    "comment_id" => $comment->id,
                ]);

            }
        }


        return response()->json("ok");
    }

}
