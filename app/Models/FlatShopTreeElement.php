<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FlatShopTreeElement extends Model
{
    public static function getLowers($shop_tree_element_ids): Collection
    {
        return self::_getLowers($shop_tree_element_ids, true);
    }

    public static function getLowersWithoutSelf($shop_tree_element_ids): Collection
    {
        return self::_getLowers($shop_tree_element_ids, false);
    }

    public static function getUppers($shop_tree_element_ids): Collection
    {
        return self::_getUppers($shop_tree_element_ids, true);
    }

    protected $table = "flat_shop_tree_elements";

    private static function _getLowers(Collection $shop_tree_element_ids, $include_self): Collection
    {
        if($shop_tree_element_ids->isEmpty()) return collect();
        $ids = $shop_tree_element_ids->implode(",");
        $column_name = $include_self ? "id" : "parent_id";
        return collect(DB::select(<<<EOM
            with recursive flat_shop_tree_elements(id, name, parent_id) as (
                select id, name, parent_id
                from shop_tree_elements
                where $column_name in ($ids)
                union
                select A1.id, A1.name, A1.parent_id
                from shop_tree_elements as A1, flat_shop_tree_elements as B1
                where A1.parent_id = B1.id
            )
            select * from flat_shop_tree_elements;
EOM
        ));
    }

    private static function _getUppers(Collection $shop_tree_element_ids, $include_self): Collection
    {
        if($shop_tree_element_ids->isEmpty()) return collect();
        $ids = $shop_tree_element_ids->implode(",");
        $column_name = $include_self ? "id" : "parent_id";
        return collect(DB::select(<<<EOM
            with recursive flat_shop_tree_elements(id, name, parent_id) as (
                select id, name, parent_id
                from shop_tree_elements
                where $column_name in ($ids)
                union
                select A1.id, A1.name, A1.parent_id
                from shop_tree_elements as A1, flat_shop_tree_elements as B1
                where A1.id = B1.parent_id
            )
            select * from flat_shop_tree_elements;
EOM
        ));
    }
}
