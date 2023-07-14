<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate([
            'alter' => 'site'
        ], [
            'alter' => 'site',
            'content' => $this->content(),
            'seo' => $this->seo(),
        ]);
    }

    protected function seo(): array
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'telegram' => 'https://web.telegram.org',
            'youtube' => 'https://youtube.com',
            'profi' => 'https://profi.ru',
            'tenchat' => 'https://tenchat.ru',
            'map' => 'https://yandex.ru/maps/-/CLrq7rR',
            'whatsapp' => '+79686868685',
            'phone' => '+7 (925) 008-79-01',
            'address' => 'Ул. Александра Солженицына 42',
            'signal' => '@detective',
            'email' => 'Pershin-detective@yandex.ru',
        ];
    }

    protected function content(): array
    {
        $faq = [];

        for ($i = 0; $i < 6; $i++) {
            $faq[] = [
                'question' => fake()->sentence(),
                'answer' => fake()->paragraph,
            ];
        }

        return [
            'faq' => $faq,
            'city1' => [
                'name' => 'Москва',
                'phone' => '+7 (968) 686-86-85',
                'address' => 'Ул. Александра Солженицына 42',
            ],
            'city2' => [
                'name' => 'Санкт-Петербург',
                'phone' => '+7 (968) 686-86-85',
                'address' => 'Ул. Ленина д.10',
            ],
            'videos' => [
                'https://www.youtube.com/watch?v=GIGXKMe2xZw',
                'https://www.youtube.com/watch?v=LdyDTyZZDPI',
            ],
            'block1' => [
                'text' => 'PERSHIN & PARTNERS - это международное детективное агентство нового формата, практикующие наиболее эффективные методы работы на рынке детективных услуг. С помощью современного аналитического отдела по поиску информации, оперативных комбинаций и стратегии разведывательного подхода посредством внедрения- компания решает сложнейшие задачи в семейных конфликтах, проблемах с детьми и подростками, информационных войн с конкурентами, коммерческой разведке и других серьезных проблемах. <br> Руководитель и лицо компании - Першин Кирилл Олегович – имеет большой эмпирический опыт в оказании детективных услуг, состоит в партнерских отношениях с ведущим медийным детективным агентством «Legion», является участником международных ассоциации детективов, ведет открытую и прозрачную политику работы, призывает не верить на слово своих заказчиков, а опираться только на подробные отчёты и факты. Кирилл Олегович активно ведёт свой YouTube блог и социальные сети, где как специалист по безопасности даёт необходимые рекомендации, полезный материал и рассказывает о своих услугах и принципах их оказания.',
                'items' => [
                    ['header' => 'Современная команда', 'description' => 'Подход к делу наших опытных сотрудников и методы работы отличает нас от других детективных агентств.'],
                    ['header' => 'Мы - 100% конфиденциальность', 'description' => 'На нашем YouTube канале Кирилл рассказал о гарантиях конфиденциальности в нашей компании.'],
                    ['header' => 'Прагматичный подход', 'description' => 'Мы заинтересованы в результате, нам не интересно тянут ваш кейс годами, мы за прагматизм дела.'],
                    ['header' => 'Эмпирический опыт', 'description' => 'Наша компания более 5 лет расследует и решает нестандартные личные, семейные и бизнес проблемы'],
                    ['header' => 'Доверие к нашей компани', 'description' => 'Сложно доверять тем, кто в тени, но наша компания имеет личный бренд, который можно потерять лишь один раз.'],
                ]
            ],
            'block2' => [
                'header' => 'Первичное взаимодействие с нами',
                'description' => 'Мы понимаем опасение наших Заказчиков перед консультацией у частного детектива, связанное с обращением к незнакомому специалисту (третьему лицу) с целью поделиться проблемой и передать конфиденциальные сведения. <br> Опасения по поводу утечки информации более чем естественны в этой ситуации, поэтому специалистами нашей компании были подготовлены несколько видов консультаций, различных по уровню конфиденциальности.',
                'items' => [
                    ['header' => 'Личная консультация в офисе агентства', 'description' => '<li>Нет необходимости в документах при посещении</li><li>Возможность прийти в маске с целью скрыть лицо</li><li>Никаких подписаний документов</li><li>Отсутствие аудио-видео фиксации</li>'],
                    ['header' => 'Общение через посредника', 'description' => '<li>Личное присутствие необязатьельно</li><li>Вы можете прислать доверенное лицо для решения проблемы</li><li>Сохранение анонимности вашей проблемы путём рассказа от 3 лица</li>'],
                    ['header' => 'Выездная консультация', 'description' => '<li>Проведение консультации натерритории вашей собственности</li><li>Сохранение комфортных для Вас условий встречи</li><li>Никаких подписаний документов</li><li>Отсутствие аудио-видео фиксации</li>'],
                    ['header' => 'Онлайн-консультация', 'description' => '<li>Любой удобный для Вас способ связи</li><li>Вы можете не использовать веб камеру</li><li>Вы можете использовать сторонние сервера и VPN</li>'],
                ]
            ],
            'block3' => [
                'post' => 'Руководитель детективного агентства',
                'name' => 'Першин Кирилл Олегович',
                'about' => 'Руководитель и лицо компании - Першин Кирилл Олегович – имеет большой эмпирический опыт в оказании детективных услуг, состоит в партнерских отношениях с ведущим медийным детективным агентством "Legion", является участником международных ассоциации детективов, ведет открытую и прозрачную политику работы, призывает не верить на слово своих заказчиков, а опираться только на подробные отчёты и факты. <br> Кирилл Олегович активно ведёт свой YouTube блог и социальные сети, где как специалист по безопасности даёт необходимые рекомендации, полезный материал и рассказывает о своих услугах и принципах их оказания.',
                'experience' => 'Стаж в частной практике более 15 лет'
            ],
            'block4' => [
                'header' => 'Мы гарантируем сохранять в тайне',
                'description' => '<ul><li>Персональные данные Заказчика</li><li>Любую приватную информацию, относящуюся к делу</li><li>Коммерческую тайну — Результаты нашей деятельности</li><li>Результаты нашей деятельности</li><li>Договор об оказании услуг (уничтожается)</li><li>Факт посещения человеком офиса (любого его присутствия)</li><li>Стоимость контракта об оказании услуг</li><li>Материалы сообщений, контакты и отчеты (безвозвратное удаление)</li></ul>',
            ],
        ];
    }
}
