<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array_map(fn($item) => ['name' => $item], [
            "Амбулатория",
            "Больница",
            "Гинекологическая клиника",
            "Глазная клиника",
            "Госпиталь",
            "Детская больница",
            "Детская клиника",
            "Детская поликлиника ",
            "Диагностический центр",
            "Диспансер",
            "Женская консультация",
            "Кабинет врача",
            "Клиника",
            "Косметология",
            "Лаборатория (анализы)",
            "Медсанчасть",
            "Наркология",
            "Оздоровительная клиника",
            "Поликлиника",
            "Роддом",
            "Санаторий",
            "Скорая помощь",
            "Специализированная клиника",
            "Стоматологическая поликлиника ",
            "Стоматология",
            "Травмпункт",
            "Электронная регистратура"
        ]);

        Category::insert($categories);
    }
}
