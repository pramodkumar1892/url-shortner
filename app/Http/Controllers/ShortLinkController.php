<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortLinkController extends Controller
{

    /**
     * Convert link to a short code
     * @param  Request $request
     * @return string
     */
    public function shortenLink(Request $request){

        // URL Validation
        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), config('constants.VALIDATION_FAILED'));
        }

        $link = strtolower($request->link);
        $find = ShortLink::where('link', $link)->first();
        if($find){
            return build_short_url($find->code);
        }

        // If duplicate shortCode exists, generate new one
        $codeExists = true;
        do{
            $shortCode = create_short_code();
            // Find case sensitive shortCode
            $find = ShortLink::whereRaw('BINARY `code` = ? ', [$shortCode])->first();
            if(!$find) $codeExists = false;
        }
        while($codeExists);

        $entry = new ShortLink();
        $entry['code'] = $shortCode;
        $entry['link'] = $link;
        $result = $entry->save();

        if($result){
            $url = build_short_url($shortCode);
            return response($url, config('constants.CREATED'));
        }
    }

    /**
     * Fetch link with respect
     * to the short link
     * @param  Request $request
     * @param  string $shortCode
     * @return string
     */
    public function getLink(Request $request, $shortCode){

        // Find case sensitive shortCode
        $find = ShortLink::whereRaw('BINARY `code` = ? ', [$shortCode])->first();

        // Hit counter update
        if($find){
            $hitsCount = $find->hits;
            $find->hits = $hitsCount + 1;
            $find->save();
            return $find->link;
        } else {
            return response([], config('constants.NOT_FOUND'));
        }
    }

    /**
     * Fetch hits on the short link
     * @param  Request $request
     * @param  string $shortCode
     * @return string
     */
    public function getHits(Request $request, $shortCode){
        // Find case sensitive shortCode
        $find = ShortLink::whereRaw('BINARY `code` = ? ', [$shortCode])->first();
        if($find){
            return response([
                'link' => $find->link,
                'hits' => $find->hits
            ], config('constants.SUCCESS'));
        } else {
            return response([], config('constants.NOT_FOUND'));
        }
    }
}
