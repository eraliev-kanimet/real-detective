<?php

namespace App\Filament\Resources\PageResource;

use App\Helpers\FilamentHelper;

class PageResourceForm
{
    public static function form(): array
    {
        $helper = new FilamentHelper;

        return [
            $helper->tabs([
                $helper->tab('Свойства сайта', [
                    $helper->fieldset('SEO', [
                        $helper->textInput('seo.title')->label('Заголовок'),
                        $helper->textarea('seo.description')->label('Описание'),
                    ]),
                    $helper->grid([
                        $helper->textInput('seo.phone')->label('Телефон'),
                        $helper->textInput('seo.address')->label('Адрес'),
                        $helper->textInput('seo.email'),
                    ], 3),
                    $helper->fieldset('Социальные сети', [
                        $helper->textInput('seo.telegram')->prefix('@'),
                        $helper->textInput('seo.youtube'),
                        $helper->textInput('seo.profi')->label('Профи'),
                        $helper->textInput('seo.tenchat'),
                        $helper->textInput('seo.whatsapp'),
                        $helper->textInput('seo.signal'),
                    ], 2),
                    $helper->textInput('seo.reviews'),
                ]),
                $helper->tab('Главная страница', [
                    $helper->textInputNullable('seo.map')->label('Карта API KEY'),
                    $helper->tabs([
                        $helper->tab('Видеоролики', [
                            $helper->repeater('content.videos', [
                                $helper->image('preview'),
                                $helper->textInput('link')
                            ])->label('')
                                ->createItemButtonLabel('Добавить видео')
                                ->required(),
                        ]),
                        $helper->tab('Блок 1', [
                            $helper->richEditor('content.block1.text')->label(''),
                            $helper->repeater('content.block1.items', [
                                $helper->textInput('header')->label('Заголовок'),
                                $helper->richEditor('description')->label('Описание')
                            ])->label('Пункты')
                        ]),
                        $helper->tab('Блок 2', [
                            $helper->textInput('content.block2.header')->label('Заголовок'),
                            $helper->richEditor('content.block2.description')->label('Описание'),
                            $helper->repeater('content.block2.items', [
                                $helper->textInput('header')->label('Заголовок'),
                                $helper->richEditor('description')->label('Описание')
                            ])->label('Пункты')
                        ]),
                        $helper->tab('Блок 3', [
                            $helper->grid([
                                $helper->textInput('content.block3.name')->label('Имя'),
                                $helper->textInput('content.block3.post')->label('Должность'),
                                $helper->textInput('content.block3.experience')->label('Опыт'),
                            ], 3),
                            $helper->richEditor('content.block3.about')->label('О себе')
                        ]),
                        $helper->tab('Блок 4', [
                            $helper->textInput('content.block4.header')->label('Заголовок'),
                            $helper->richEditor('content.block4.description')->label('Описание')
                        ]),
                        $helper->tab('FAQ', [
                            $helper->repeater('content.faq', [
                                $helper->textInput('question')->label('Вопрос'),
                                $helper->richEditor('answer')->label('Ответ')
                            ])->label(''),
                        ]),
                    ])
                ]),
            ])
        ];
    }
}
