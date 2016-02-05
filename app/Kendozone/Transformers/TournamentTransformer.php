<?php
/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 04/02/2016
 * Time: 22:43
 */

namespace Kendozone\Transformers;


class TournamentTransformer extends Transformer{


    public function transform($tournament)
    {
        return [
            'id' =>$tournament['id'],
            'user_id' => $tournament['user_id'],
            'name' => $tournament['name'],
            'date' => $tournament['date'],
            'registerDateLimit' => $tournament['registerDateLimit'],
            'sport' => $tournament['sport'],
            'type' => $tournament['type'],
            'mustPay' => (bool) $tournament['mustPay'],
            'venue' => $tournament['venue'],
            'latitude' => $tournament['latitude'],
            'longitude' => $tournament['longitude'],
            'level_id' => $tournament['level_id'],
        ];
    }
}
