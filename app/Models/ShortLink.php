<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ShortLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeNotExpired(Builder $query): void
    {
        $query->where('expired_at', '>', Carbon::now());
    }

    public static function generateShortLink($request): ShortLink
    {
        $count = ShortLink::count();
        $slug =  config('app.urlShortLink') . Str::random(8) . $count;
        $link = new ShortLink([
            'name' => $request->input('name'),
            'slug' => $slug,
            'target_url' => $request->input('url'),
            'expired_at' => new Carbon($request->input('expired_date'))
        ]);

        $link->save();
        return $link;
    }

}
