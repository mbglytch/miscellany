<?php

namespace App\Services;

use App\Campaign;
use App\Models\Character;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StarterService
{
    /**
     * @param Campaign $campaign
     */
    public static function generateBoilerplate(Campaign $campaign)
    {
        // Generate locations
        $kingdom = new Location([
            'name' => trans('starter.kingdom1.name'),
            'type' => trans('starter.kingdom1.type'),
            'description' => '<p>' . trans('starter.kingdom1.description') . '</p>',
            'history' => '<p>' . trans('starter.kingdom1.history') . '</p>',
            'campaign_id' => $campaign->id,
            'is_private' => false,
        ]);
        $kingdom->save();

        $city = new Location([
            'name' => trans('starter.kingdom2.name'),
            'type' => trans('starter.kingdom2.type'),
            'parent_location_id' => $kingdom->id,
            'description' => '<p>' . trans('starter.kingdom2.description') . '</p>',
            'history' => '<p>' . trans('starter.kingdom2.history') . '</p>',
            'campaign_id' => $campaign->id,
            'is_private' => false,
        ]);
        $city->save();

        $james = new Character([
            'name' => trans('starter.character1.name'),
            'title' => trans('starter.character1.title'),
            'age' => '43',
            'race' => trans('starter.character1.race'),
            'sex' => trans('starter.character1.sex'),
            'history' => '<p>' . trans('starter.character1.history') . '</p>',
            'location_id' => $city->id,
            'campaign_id' => $campaign->id,
            'fears' => trans('starter.character1.fears'),
            'traits' => trans('starter.character1.traits'),
            'is_private' => false,
        ]);
        $james->save();

        $irwie = new Character([
            'name' => trans('starter.character2.name'),
            'title' => trans('starter.character2.title'),
            'age' => '31',
            'race' => trans('starter.character2.race'),
            'sex' => trans('starter.character2.sex'),
            'history' => '<p>' . trans('starter.character2.history') . '</p>',
            'location_id' => $city->id,
            'campaign_id' => $campaign->id,
            'fears' => trans('starter.character2.fears'),
            'traits' => trans('starter.character2.traits'),
            'is_private' => false,
        ]);
        $irwie->save();

        $item = new Item([
            'name' => trans('starter.item1.name'),
            'campaign_id' => $campaign->id,
            'type' => trans('starter.item1.type'),
            'description' => '<p>' . trans('starter.item1.description') . '</p>',
            'history' => '<p>' . trans('starter.item1.history') . '</p>',
            'character_id' => $irwie->id,
            'location_id' => $kingdom->id,
            'is_private' => false,
        ]);
        $item->save();
    }
}
