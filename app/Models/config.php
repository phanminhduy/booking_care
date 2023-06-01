<?php

namespace App\Models;

use App\Enums\SystemCacheKeyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getAndCache($isPublic): array
    {

        return cache()->remember(
            SystemCacheKeyEnum::CONFIGS . $isPublic,
            86000 * 30,
            function () use ($isPublic) {
                $data = self::query()
                    ->where('is_public', $isPublic)
                    ->get();
                $arr = [];

                foreach ($data as $each) {
                    $arr[$each->key] = $each->value;
                }

                return $arr;
            }
        );
    }
}
