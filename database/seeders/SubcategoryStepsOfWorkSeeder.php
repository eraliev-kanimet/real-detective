<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoryStepsOfWorkSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Subcategory::all() as $subcategory) {
            $basic = $subcategory->basic;

            $basic['steps_of_work'] = [
                [
                    'header' => 'Заявка на услугу',
                    'content' => 'Оставляете заявку любым удобным способом',
                ],
                [
                    'header' => 'Консультация',
                    'content' => 'Бесплатная консультация и обсуждение деталей',
                ],
                [
                    'header' => 'Предоплата',
                    'content' => 'После обсуждения деталей - внесение предоплаты',
                ],
                [
                    'header' => 'Выполнение',
                    'content' => 'Переходим к выполнению поставленных задач',
                ],
                [
                    'header' => 'Отчет',
                    'content' => 'Предоставление полного отчета о проделанной работе',
                ],
            ];

            $subcategory->update([
                'basic' => $basic
            ]);
        }
    }
}
