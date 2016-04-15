<?php
/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 04/02/2016
 * Time: 22:43
 */

namespace Kendozone\Transformers;


class CategoryTransformer extends Transformer{


    public function transform($category)
    {
        return [
            'id' =>$category['id'],
            'name' => $category['name'],
            'gender' => $category['gender'],
            'isTeam' => $category['isTeam'],
            'ageCategory' => $category['ageCategory'],
//            'sport' => $tournament['sport'],
//            'type' => $tournament['type'],
//            'mustPay' => (bool) $tournament['mustPay'],
//            'venue' => $tournament['venue'],
//            'latitude' => $tournament['latitude'],
//            'longitude' => $tournament['longitude'],
//            'level_id' => $tournament['level_id'],
        ];
    }
}
