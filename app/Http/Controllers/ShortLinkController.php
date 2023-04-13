<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortLinkRequest;
use App\Http\Resources\ShortLinkResource;
use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShortLinkController extends Controller
{
    //
    public function createShortLink(CreateShortLinkRequest $request): ShortLinkResource
    {
        $link = ShortLink::where('target_url', $request->input('url'))->notExpired()->first();
        if ($link) return new ShortLinkResource($link);

        $link = ShortLink::generateShortLink($request);
        return new ShortLinkResource($link);
    }

    public function redirectLink($slug)
    {
        $link = ShortLink::where('slug', config('app.urlShortLink') . $slug)->notExpired()->first();
        if($link){
            return redirect($link->target_url);
        }else{
            throw new NotFoundHttpException();
        }
    }

    public function getAllShortLinks()
    {
        $links = ShortLink::all();
        return ShortLinkResource::collection($links);
    }
}
