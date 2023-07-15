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
                $helper->tab('Site properties', [
                    $helper->fieldset('SEO', [
                        $helper->textInput('seo.title'),
                        $helper->textarea('seo.description'),
                    ]),
                    $helper->grid([
                        $helper->textInput('seo.phone'),
                        $helper->textInput('seo.address'),
                    ]),
                    $helper->fieldset('Social networks', [
                        $helper->textInput('seo.email'),
                        $helper->textInput('seo.telegram'),
                        $helper->textInput('seo.youtube'),
                        $helper->textInput('seo.profi'),
                        $helper->textInput('seo.tenchat'),
                        $helper->textInput('seo.whatsapp'),
                        $helper->textInput('seo.signal'),
                    ], 2),
                ]),
                $helper->tab('The home page', [
                    $helper->textInput('seo.map'),
                    $helper->tags('content.videos')->placeholder('New video'),
                    $helper->tabs([
                        $helper->tab('Block 1', [
                            $helper->richEditor('content.block1.text'),
                            $helper->repeater('content.block1.items', [
                                $helper->textInput('header'),
                                $helper->richEditor('description')
                            ])
                        ]),
                        $helper->tab('Block 2', [
                            $helper->textInput('content.block2.header'),
                            $helper->richEditor('content.block2.description'),
                            $helper->repeater('content.block2.items', [
                                $helper->textInput('header'),
                                $helper->richEditor('description')
                            ])
                        ]),
                        $helper->tab('Block 3', [
                            $helper->grid([
                                $helper->textInput('content.block3.post'),
                                $helper->textInput('content.block3.name'),
                                $helper->textInput('content.block3.experience'),
                            ], 3),
                            $helper->richEditor('content.bloc3.about')
                        ]),
                        $helper->tab('Block 4', [
                            $helper->textInput('content.block4.header'),
                            $helper->richEditor('content.block4.description')
                        ]),
                        $helper->tab('FAQ', [
                            $helper->repeater('content.faq', [
                                $helper->textInput('question'),
                                $helper->richEditor('answer')
                            ]),
                        ]),
                    ])
                ]),
                $helper->tab('The contacts page', [
                    $helper->fieldset('City 1', [
                        $helper->grid([
                            $helper->textInput('content.city1.name'),
                            $helper->textInput('content.city1.phone'),
                            $helper->textInput('content.city1.address'),
                        ], 3),
                    ], 2),
                    $helper->fieldset('City 2', [
                        $helper->grid([
                            $helper->textInput('content.city2.name'),
                            $helper->textInput('content.city2.phone'),
                            $helper->textInput('content.city2.address'),
                        ], 3),
                    ], 2),
                ]),
            ])
        ];
    }
}
