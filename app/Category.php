<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'image', 'status', 'sort_order', 'parent_id', 'top', 'seo_url', 'seo_url_path'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function auctions()
    {
        return $this->belongsToMany(Auction::class, 'category_to_auctions');
    }



    /*public function auction()
    {
        return $this->belongsToMany(Auction::class);
    }*/

    /*
     * select categories.name, count(auctions.id) as 'total_auctions'
       from categories
       left join auctions
        on categories.id = auctions.category_id
        group by categories.name;
     */
    public function getTopLevelCategoriesWithAuctionsCount()
    {
        $categories_table_name = $this->getTable();
        $auctions_table_name = (new Auction())->getTable();
        return $this
            ::where('top', '=', 1)
            ->where('status', '=', 1)
            ->orderByDesc('sort_order')
            ->orderBy('id')


            //->select("{$categories_table_name}.id", "{$categories_table_name}.name", \DB::raw("COUNT({$auctions_table_name}.id)"))
            ->select(
                "{$categories_table_name}.id",
                "{$categories_table_name}.name",
                "{$categories_table_name}.seo_url_path",

                \DB::raw("COUNT({$auctions_table_name}.id) as 'total_auction_items'"))
            //->leftJoin("{$auctions_table_name}", 'categories.id', '=', "{$auctions_table_name}.category_id")

            ->leftJoin("category_to_auctions", "categories.id", '=', "category_to_auctions.category_id")
            ->leftJoin("auctions", 'auctions.id', '=', "category_to_auctions.auction_id")

            //->groupBy("{$categories_table_name}.id", "{$categories_table_name}.name")
            ->groupBy(
                "{$categories_table_name}.id",
                "{$categories_table_name}.name",
                "{$categories_table_name}.seo_url_path"
            )
            ->get()
        ;
    }


    public static function getTopLevelCategories()
    {
        return Category
            ::where('top', '=', 1)
            ->where('status', '=', 1)
            ->orderByDesc('sort_order')
            ->orderBy('id')
            ->get()
            ;
    }


    public function getSubcategoriesWithAuctionsCount($category_id)
    {
        $categories_table_name = $this->getTable();
        $auctions_table_name = (new Auction())->getTable();
        return $this
            ::where('parent_id', '=', $category_id)
            ->where('status', '=', 1)
            ->orderByDesc('sort_order')
            ->orderBy('id')


            ->select(
                "{$categories_table_name}.id",
                "{$categories_table_name}.name",
                "{$categories_table_name}.seo_url_path",

                \DB::raw("COUNT({$auctions_table_name}.id) as 'total_auction_items'"))
            //->leftJoin("{$auctions_table_name}", 'categories.id', '=', "{$auctions_table_name}.category_id")

            ->leftJoin("category_to_auctions", "categories.id", '=', "category_to_auctions.category_id")
            ->leftJoin("auctions", 'auctions.id', '=', "category_to_auctions.auction_id")

            ->groupBy(
                "{$categories_table_name}.id",
                "{$categories_table_name}.name",
                "{$categories_table_name}.seo_url_path"
            )
            ->get()
            ;
    }

    public static function getSubcategories($category_id)
    {
        return Category
            ::where('parent_id', '=', $category_id)
            ->where('status', '=', 1)
            ->orderByDesc('sort_order')
            ->orderBy('id')
            ->get()
        ;
    }

    public static function getParentCategories($category_id){
        /**
         *
        SELECT T2.id, T2.name
        FROM (
        SELECT
        @r AS _id,
        (SELECT @r := parent_id FROM categories WHERE id = _id) AS parent_id,
        @l := @l + 1 AS lvl
        FROM
        (SELECT @r := (SELECT id FROM categories WHERE id = 2), @l := 0) vars,
        categories h
        WHERE @r <> 0) T1
        JOIN categories T2
        ON T1._id = T2.id
        ORDER BY T1.lvl DESC
         */

    }

    public function getParentsCategories($category_id) {

        $category = Category::where("id", '=', $category_id)->first();

        //return $category;

        /*if($category->parent_id == null){
            return $category;
        }*/


        //f($category->parent_id !== null) {
            if ($category->parentCategory() && $category !== null) {
                $parentCategory = $category->parentCategory()->first();
                if($parentCategory !== null) {
                    return $parentCategory->getParentsCategories($parentCategory->id);
                }else{
                    return $category;
                }
            } else {
                return $category;
            }
        //}
    }

    public static function getCategory($category_id)
    {
        $category = Category::query()
            ->where('id', '=', $category_id)
            ->where('status', '=', 1)
            ->first()
        ;

        if(!isset($category)){
            return null;
        }

        return $category;

    }

    public static function getCategoryFromSlug($seo_url_path)
    {
        $category = Category::query()
            ->where('seo_url_path', $seo_url_path)
            ->where('status', '=', 1)
            ->first();

        if(!isset($category)){
            return null;
        }

        return $category;
    }

    public static function getPath($category_id){
        $path_array = [];

        $result = self::getCategory($category_id);

        if(!isset($result))return '';

        $path_array[] = $result;

        do {
            if(!isset($result))
            {
                return;
            }
            $result = self::getCategory($result->parent_id);
            $path_array[] = $result;
        }while(!isset($result) || $result->top !== 1 || !isset($result->top));

        $path_array = array_reverse($path_array);

        return $path_array;
    }
}
