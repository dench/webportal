<?php

use yii\db\Migration;

class m160707_114341_insert_to_article_category extends Migration
{
    public function up()
    {
        $data = [
            ['Статьи', null, 'items' => [
                ['Архитектура', 'architecture-main', 'items' => [
                    ['Отделка и ремонт', 'remont'],
                    ['Кровля и мансарда', 'krovlya-mansarda'],
                    ['Фундамент', 'fundament'],
                    ['Стены и перекрытия', 'stena-perekrytiya'],
                    ['Печи и камины', 'pechka-kaminy'],
                    ['Ворота, лестницы, двери и окна', 'vorota-lestnica-dveri-windows'],
                    ['Изделия из дерева', 'derevyannyie-izdeliya'],
                    ['Полы и потолки', 'poly-potolki'],
                    ['Хозяйственные постройки', 'hozyaystvennyie-postroyki'],
                    ['Баня, сауна, бассейн', 'banya-sauna-pool'],
                    ['Архитектурные решения', 'architecture'],
                ]],
                ['Инженерные системы и коммуникации', 'inzhenernye-sistemy', 'items' => [
                    ['Системы отопления и сантехника', 'santehnika'],
                    ['Освещение и электрика', 'elektrika'],
                    ['Умный дом', 'umniy-dom'],
                    ['Водоснабжение и коммуникации', 'vodosnabzhenie'],
                    ['Вентиляция и кондиционирование', 'ventilyaciya-kondicionirovanie'],
                    ['Альтернативные источники энергии и энергосбережение', 'alternativnye-istochniki-energii'],
                    ['Газификация', 'gazifikaciy'],
                ]],
                ['Материалы', 'material', 'items' => [
                    ['Отделочные материалы', 'otdelka'],
                    ['Металлопрокат', 'metalloprokat'],
                    ['Фасадные материалы', 'fasad'],
                    ['Бетон и ЖБИ', 'beton'],
                    ['Напольные материалы', 'napolnye'],
                    ['Пиломатериалы', 'pilomaterial'],
                    ['Кладочные материалы', 'kladka'],
                    ['Кровельные материалы', 'krovlya'],
                    ['Строительная химия', 'himiya'],
                    ['Сыпучие и вяжущие материалы', 'sypuchie-vyazhushchie'],
                ]],
                ['Сад, огород и обустройство участка', 'garden-ogorod', 'items' => [
                    ['Уход за участком', 'uhod-uchastok'],
                    ['Ландшафтный дизайн', 'landshaft-design'],
                    ['Ограждения', 'zabor'],
                    ['Газон и клумбы', 'gazon-klumba'],
                    ['Сад', 'garden'],
                ]],
                ['Оборудование', 'equipment-main', 'items' => [
                    ['Ручной инструмент', 'instrument'],
                    ['Садовая техника', 'sadovaya-tehnika'],
                    ['Строительное оборудование', 'equipment'],
                ]],
                ['Дизайн интерьеров', 'design', 'items' => [
                    ['Гостиная', 'gostinaya'],
                    ['Кухня', 'kuhni'],
                    ['Спальня', 'room'],
                    ['Кабинет', 'office'],
                    ['Прихожая', 'prihozhaya'],
                    ['Санузел', 'tualet'],
                    ['Дизайн домов', 'design-house'],
                    ['Детские комнаты', 'detskaya-room'],
                ]],
            ]],
        ];

        $this->down();

        $this->insertData($data);
    }

    public function down()
    {
        $this->delete('article_category');
        
        $this->db->createCommand("SET FOREIGN_KEY_CHECKS = 0;")->execute();

        $this->truncateTable('article_category');

        $this->db->createCommand("SET FOREIGN_KEY_CHECKS = 1;")->execute();
    }
    
    private function insertData($data, $parent_id = null)
    {
        foreach ($data as $d) {
            $this->insert('article_category', [
                'parent_id' => $parent_id,
                'name' => $d[0],
                'title' => $d[0],
                'slug' => $d[1],
            ]);
            $id = Yii::$app->db->getLastInsertID();
            $this->update('article_category', ['position' => $id], ['id' => $id]);
            if (isset($d['items'])) {
                $this->insertData($d['items'], $id);
            }
        }
    }
}
