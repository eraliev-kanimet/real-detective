<?php

namespace App\Filament\Resources\PageResource;

use App\Helpers\FilamentHelper;

class PageResourceForm
{
    public function __construct(
        protected FilamentHelper $helper
    )
    {
    }

    public static function form(): array
    {
        $helper = new FilamentHelper;
        $self = new self($helper);

        return [
            $helper->tabs([
                $helper->tab('Site properties', $self->siteProperties()),
                $helper->tab('The home page', $self->theHomePage()),
                $helper->tab('The contacts page', $self->theContactsPage()),
            ])
        ];
    }

    protected function siteProperties(): array
    {
        return [
            $this->helper->fieldset('SEO', [
                $this->helper->textInput('seo.title'),
                $this->helper->textInput('seo.description'),
            ]),
            $this->helper->textInput('seo.phone'),
            $this->helper->textInput('seo.address'),
            $this->helper->fieldset('Social networks', [
                $this->helper->textInput('seo.email'),
                $this->helper->textInput('seo.telegram'),
                $this->helper->textInput('seo.youtube'),
                $this->helper->textInput('seo.profi'),
                $this->helper->textInput('seo.tenchat'),
                $this->helper->textInput('seo.whatsapp'),
                $this->helper->textInput('seo.signal'),
            ], 2),
        ];
    }

    protected function theContactsPage(): array
    {
        return [
            $this->helper->fieldset('City 1', [
                $this->helper->textInput('content.city1.name'),
                $this->helper->textInput('content.city1.phone'),
                $this->helper->textInput('content.city1.address'),
            ], 2),
            $this->helper->fieldset('City 2', [
                $this->helper->textInput('content.city2.name'),
                $this->helper->textInput('content.city2.phone'),
                $this->helper->textInput('content.city2.address'),
            ], 2),
        ];
    }

    protected function theHomePage(): array
    {
        return [
            $this->helper->textInput('seo.map'),
            $this->helper->tags('content.videos'),
            $this->helper->tabs([
                $this->helper->tab('Block 1', [
                    $this->helper->richEditor('content.block1.text'),
                    $this->helper->repeater('content.block1.items', [
                        $this->helper->textInput('header'),
                        $this->helper->richEditor('description')
                    ])
                ]),
                $this->helper->tab('Block 2', [
                    $this->helper->textInput('content.block2.header'),
                    $this->helper->richEditor('content.block2.description'),
                    $this->helper->repeater('content.block2.items', [
                        $this->helper->textInput('header'),
                        $this->helper->richEditor('description')
                    ])
                ]),
                $this->helper->tab('Block 3', [
                    $this->helper->textInput('content.block3.post'),
                    $this->helper->textInput('content.block3.name'),
                    $this->helper->textInput('content.block3.experience'),
                    $this->helper->richEditor('content.bloc3.about')
                ]),
                $this->helper->tab('Block 4', [
                    $this->helper->textInput('content.block4.header'),
                    $this->helper->richEditor('content.block4.description')
                ]),
                $this->helper->tab('FAQ', [
                    $this->helper->repeater('content.faq', [
                        $this->helper->textInput('question'),
                        $this->helper->richEditor('answer')
                    ]),
                ]),
            ])
        ];
    }
}
