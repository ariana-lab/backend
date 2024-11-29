<?php

use Carbon\Carbon;

class TransformAnimeData
{
    public static function transform($data)
    {
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d H:i:s');
        return $data;

        $data = TransformAnimeData::transform($request->all());
        Anime::create($data);

    }
}
