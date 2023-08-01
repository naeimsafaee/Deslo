<?php

use App\Models\Meta;
use App\Models\Sms;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if(!function_exists('Kavenegar')){


    function Kavenegar($phone, $message, $is_message = false){

        $curl = curl_init();

        if($is_message){
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.kavenegar.com/v1/" . config('Constants.SMS_API') . "/sms/send.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => [
                    'receptor' => $phone,
                    'message' => $message,
                ],
            ]);
        } else {
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.kavenegar.com/v1/" . config('Constants.SMS_API') . "/verify/lookup.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => [
                    'receptor' => $phone,
                    'token' => $message,
                    'template' => "deslo",
                ],
            ]);
        }

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        return $response;
    }
}

if(!function_exists('fa_number')){
    function fa_number($number, $flip = false){
        if(empty($number)){
            return '۰';
        }

        $en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        if($flip){
            return str_replace($fa, $en, $number);
        } else {
            return str_replace($en, $fa, $number);
        }

    }
}

if(!function_exists('json_printer')){
    function json_printer($data){
        $html = '<div class="tablesimpleresponsive">
          <table class="tablesimple" style="min-width:auto">
            <thead>
              <tr>
                <th>' . __('hotdesk.read_table_title') . '</th>
                <th>' . __('hotdesk.read_table_info') . '</th>
              </tr>
            </thead>
            <tbody>';
        foreach($data as $keydata => $dataof){
            $html .= '<tr>
                <td>' . $keydata . '</td>
                <td>';
            if(is_array($dataof)){
                $html .= json_printer($dataof);
            } else {
                try {
                    $decrypted = Crypt::decryptString($dataof);
                    if(is_serialized_string($decrypted)){
                        $decrypted = unserialize($decrypted);
                        if(is_object($decrypted)){
                            $html .= json_printer($decrypted);
                        }

                    }
                } catch(Illuminate\Contracts\Encryption\DecryptException $e){
                    $decrypted = $dataof;
                }
                if(!is_object($decrypted)){
                    $html .= '<span>' . $decrypted . '</span>';
                }

            }
            $html .= '</td>
              </tr>';
        }
        $html .= '</tbody>
          </table>
      </div>
    </div>';
        return $html;
    }
}

function is_serialized_string($string){
    return ($string == 'b:0;' || @unserialize($string) !== false);
}

if(!function_exists('_response')){
    /**
     * @param null $data
     * @param string|null $message
     * @param bool $status
     * @param int $code
     * @return JsonResponse
     */
    function _response($data = null, string $message = null, bool $status = true, $code = 200): JsonResponse{
        return response()->json([
            "data" => $data ?? [],
            "message" => $message ?? "",
            "status" => $status,
        ], $code ?? 200);
    }
}

if(!function_exists('get_image')){
    function get_image($image){
        if(!isset($image) || $image == ""){
            return "";
        }

        if(substr_count($image, 'http') == 0){
            if(substr_count($image, 'storage') > 0){
                if(substr_count($image, '/storage') > 0){
                    $image = config('app.url') . $image;
                } else {
                    $image = config('app.url') . '/' . $image;
                }

            } else {
                $image = config('app.url') . '/storage/' . $image;
            }
        }

        return preg_replace("/ /", "%20", $image);
    }
}
if(!function_exists('getFile')){
    function getFile($file){

        $json = json_decode($file);
        if($json && count($json) > 0){

            return Storage::url($json[0]->download_link);
        }
        return '';
    }
}

if(!function_exists('get_cropped_image')){
    function get_cropped_image($image, $flag = false){

        if(!isset($image) || $image == ""){
            return "";
        }

        $image = explode(".", $image);

        if($flag)
            $image[0] .= "-$flag"; else
            $image[0] .= "-cropped";
        $image = implode(".", $image);

        if(substr_count($image, 'http') == 0){
            if(substr_count($image, 'storage') > 0){
                if(substr_count($image, '/storage') > 0){
                    $image = config('app.url') . $image;
                } else {
                    $image = config('app.url') . '/' . $image;
                }

            } else {
                $image = config('app.url') . '/storage/' . $image;
            }
        }

        return preg_replace("/ /", "%20", $image);
    }
}

if(!function_exists("watermarkPhoto")){

    function watermarkPhoto(string $originalFilePath, string $filePath2Save, string $watermark_path){

        //        $watermark_path = 'photos/watermark.png';
        //        if(File::exists($watermark_path)){
        if(Storage::disk('public')->exists($watermark_path)){
            $watermarkImg = Image::make(Storage::disk("public")->get($watermark_path));
            $img = Image::make(Storage::disk("public")->get($originalFilePath));
            $wmarkWidth = $watermarkImg->width();
            $wmarkHeight = $watermarkImg->height();

            $imgWidth = $img->width();
            $imgHeight = $img->height();

            $x = 0;
            $y = 0;
            while($y <= $imgHeight){
                $img->insert(Storage::disk("public")->get($watermark_path), 'top-left', $x, $y);
                $x += $wmarkWidth;
                if($x >= $imgWidth){
                    $x = 0;
                    $y += $wmarkHeight;
                }
            }
            $img->save($filePath2Save);

            $watermarkImg->destroy();
            $img->destroy(); //  to free memory in case you have a lot of images to be processed
        } else {
            return false;
        }
        return $filePath2Save;
    }
}

if(!function_exists('meta')){
    function meta($meta_name = false){
        if($meta_name){

        } else {
            $metas = Meta::all();
        }

        $return = "";
        foreach($metas as $meta){
            $return .= '<meta name="' . $meta->name . '" content="' . $meta->content . '">';
        }

        return $return;
    }
}
