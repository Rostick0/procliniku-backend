<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = array_map(
            fn($item) => ['name' => $item, 'region_id' => 42],
            [
                'Москва',
                'Балашиха',
                'Химки',
                'Подольск',
                'Королёв',
                'Мытищи',
                'Люберцы',
                'Электросталь',
                'Коломна',
                'Одинцово',
                'Серпухов',
                'Орехово-Зуево',
                'Красногорск',
                'Щёлково',
                'Пушкино',
                'Жуковский',
                'Ногинск',
                'Раменское',
                'Домодедово',
                'Воскресенск',
                'Долгопрудный',
                'Реутов',
                'Клин',
                'Лобня',
                'Троицк (Москва)',
                'Дубна',
                'Егорьевск',
            ]
        );

        City::insert($cities);
    }
}
