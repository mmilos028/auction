<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('categories')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createCategories();
    }

    public function createCategories()
    {
        Category::create(
            [
                'name' => "Odeća",
                'description' => "Odeća",
                'image' => "",
                'status' => 1,
                'sort_order' => 999,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Odeća"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Odeća")
            ]
        );

            $subcategory = Category::where('name', 'like', 'Odeća')->first();

            Category::create(
                [
                    'name' => 'Ženska odeća',
                    'description' => "Ženska odeća",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Ženska odeća"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća") ])
                ]
            );

            $subcategory_2 = Category::where('name', 'like', 'Ženska odeća')->first();
                Category::create(
                    [
                        'name' => 'Džemperi',
                        'description' => "Džemperi",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Džemperi"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Džemperi") ])
                    ]
                );
                Category::create(
                    [
                        'name' => 'Jakne',
                        'description' => "Jakne",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Jakne"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Jakne") ])
                    ]
                );
                Category::create(
                    [
                        'name' => 'Haljine',
                        'description' => "Haljine",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Haljine"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Haljine") ])
                    ]
                );
                Category::create(
                    [
                        'name' => 'Suknje',
                        'description' => "Suknje",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Suknje"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Suknje") ])
                    ]
                );
                Category::create(
                    [
                        'name' => 'Bluze',
                        'description' => "Bluze",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Bluze"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Bluze") ])
                    ]
                );
                Category::create(
                    [
                        'name' => 'Košulje',
                        'description' => "Košulje",
                        'image' => "",
                        'status' => 1,
                        'sort_order' => 999,
                        'parent_id' => $subcategory_2->id,
                        'top' => 0,
                        'seo_url' => \Illuminate\Support\Str::slug("Košulje"),
                        'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Ženska odeća"), \Illuminate\Support\Str::slug("Košulje") ])
                    ]
                );


        Category::create(
                [
                    'name' => 'Muška odeća',
                    'description' => "Muška odeća",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Muška odeća"),
                    //'seo_url_path' => \Illuminate\Support\Str::slug("Odeća_Muška odeća"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Odeća"), \Illuminate\Support\Str::slug("Muška odeća") ])
                ]
            );

        Category::create(
            [
                'name' => "Obuća",
                'description' => "Obuća",
                'image' => "",
                'status' => 1,
                'sort_order' => 998,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Obuća"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Obuća"),
            ]
        );

            $subcategory = Category::where('name', 'like', 'Obuća')->first();

            Category::create(
                [
                    'name' => 'Ženska obuća',
                    'description' => "Ženska obuća",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Ženska obuća"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Obuća"), \Illuminate\Support\Str::slug("Ženska obuća") ])
                ]
            );

            Category::create(
                [
                    'name' => 'Muška obuća',
                    'description' => "Muška obuća",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Muška obuća"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Obuća"), \Illuminate\Support\Str::slug("Muška obuća") ])
                ]
            );

            Category::create(
                [
                    'name' => 'Ostalo',
                    'description' => "Ostalo",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Ostalo"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Obuća"), \Illuminate\Support\Str::slug("Ostalo") ])
                ]
            );

        Category::create(
            [
                'name' => "Aksesoari",
                'description' => "Aksesoari",
                'image' => "",
                'status' => 1,
                'sort_order' => 997,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Aksesoari"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Aksesoari")
            ]
        );
            $subcategory = Category::where('name', 'like', 'Aksesoari')->first();

            Category::create(
                [
                    'name' => 'Nakit',
                    'description' => "Nakit",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Nakit"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Aksesoari"), \Illuminate\Support\Str::slug("Nakit") ])
                ]
            );

            Category::create(
                [
                    'name' => 'Torbe',
                    'description' => "Torbe",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Torbe"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Aksesoari"), \Illuminate\Support\Str::slug("Torbe") ])
                ]
            );

            Category::create(
                [
                    'name' => 'Neseseri',
                    'description' => "Neseseri",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Neseseri"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Aksesoari"), \Illuminate\Support\Str::slug("Neseseri") ])
                ]
            );

            Category::create(
                [
                    'name' => 'Ručni satovi',
                    'description' => "Ručni satovi",
                    'image' => "",
                    'status' => 1,
                    'sort_order' => 999,
                    'parent_id' => $subcategory->id,
                    'top' => 0,
                    'seo_url' => \Illuminate\Support\Str::slug("Ručni satovi"),
                    'seo_url_path' => implode('-', [\Illuminate\Support\Str::slug("Aksesoari"), \Illuminate\Support\Str::slug("Ručni satovi") ])
                ]
            );

        Category::create(
            [
                'name' => "Računari i oprema",
                'description' => "Računari i oprema",
                'image' => "",
                'status' => 1,
                'sort_order' => 996,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Računari i oprema"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Računari i oprema")
            ]
        );

        Category::create(
            [
                'name' => "Mobilni telefoni",
                'description' => "Mobilni telefoni",
                'image' => "",
                'status' => 1,
                'sort_order' => 995,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Mobilni telefoni"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Mobilni telefoni")
            ]
        );
        Category::create(
            [
                'name' => "Tehnika",
                'description' => "Tehnika",
                'image' => "",
                'status' => 1,
                'sort_order' => 994,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Tehnika"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Tehnika")
            ]
        );
        Category::create(
            [
                'name' => "Mašine i alati",
                'description' => "Mašine i alati",
                'image' => "",
                'status' => 1,
                'sort_order' => 993,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Mašine i alati"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Mašine i alati")
            ]
        );
        Category::create(
            [
                'name' => "Auto i moto",
                'description' => "Auto i moto",
                'image' => "",
                'status' => 1,
                'sort_order' => 992,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Auto i moto"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Auto i moto")
            ]
        );
        Category::create(
            [
                'name' => "Za kuću i dvorište",
                'description' => "Za kuću i dvorište",
                'image' => "",
                'status' => 1,
                'sort_order' => 991,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Za kuću i dvorište"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Za kuću i dvorište")
            ]
        );
        Category::create(
            [
                'name' => "Sportska oprema",
                'description' => "Sportska oprema",
                'image' => "",
                'status' => 1,
                'sort_order' => 990,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Sportska oprema"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Sportska oprema")
            ]
        );
        Category::create(
            [
                'name' => "Za bebe i decu",
                'description' => "Za bebe i decu",
                'image' => "",
                'status' => 1,
                'sort_order' => 989,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Za bebe i decu"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Za bebe i decu")
            ]
        );
        Category::create(
            [
                'name' => "Nega tela",
                'description' => "Nega tela",
                'image' => "",
                'status' => 1,
                'sort_order' => 987,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Nega tela"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Nega tela")
            ]
        );
        Category::create(
            [
                'name' => "Knjige",
                'description' => "Knjige",
                'image' => "",
                'status' => 1,
                'sort_order' => 986,
                'parent_id' => null,
                'top' => 1,
                'seo_url' => \Illuminate\Support\Str::slug("Knjige"),
                'seo_url_path' => \Illuminate\Support\Str::slug("Knjige")
            ]
        );
    }
}
