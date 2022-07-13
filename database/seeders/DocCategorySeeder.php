<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc = [
            [
                'title' => 'Документы от вышестоящей организации',
                'docType' => 1,
            ],
            [
                'title' => 'Переписка с органами государственной власти',
                'docType' => 1,
            ],
            [
                'title' => 'Переписка с организациями, предприятиями',
                'docType' => 1,
            ],
            [
                'title' => 'Переписка с органами государственной власти',
                'docType' => 2,
            ],
            [
                'title' => 'Переписка с организациями, предприятиями',
                'docType' => 2,
            ],
            [
                'title' => 'Документы в адрес вышестоящих организаций',
                'docType' => 2,
            ],
            [
                'title' => 'Приказы по основной деятельности',
                'docType' => 3,
            ],
            [
                'title' => 'Приказы по административно-хозяйственным вопросам',
                'docType' => 3,
            ],
            [
                'title' => 'Приказы по командировкам',
                'docType' => 3,
            ],
            [
                'title' => 'О командировках сотрудников',
                'docType' => 4,
            ],
            [
                'title' => 'О разработке и  изменении штатных расписаний',
                'docType' => 4,
            ],
            [
                'title' => 'На закупку',
                'docType' => 4,
            ],
            [
                'title' => 'О возмещении расходов',
                'docType' => 4,
            ],
            [
                'title' => 'Договор купли-продажи',
                'docType' => 5,
            ],
            [
                'title' => 'Договор аренды',
                'docType' => 5,
            ],
            [
                'title' => 'Договор поставки',
                'docType' => 5,
            ],
            [
                'title' => 'Договор подряда',
                'docType' => 5,
            ],
        ];

        foreach ($doc as $el)
        {
            DB::table('doc_categories')->insert([
                'title' => $el['title'],
                'docType' => $el['docType']
            ]);
        }
    }
}
