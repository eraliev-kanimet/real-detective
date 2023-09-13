<?php
    $navbar_links = [
        route('price')  => 'Цены',
        route('articles')  => 'Блог',
        route('reviews')  => 'Отзывы',
        route('contacts')  => 'Контакты',
        route('about')  => 'О компании',
    ];

    $navbar_categories = [
        'private_person' => 'Для частных лиц',
        'business' => 'Для бизнеса',
    ];
?>

<div x-on:click="setBurger" :class="burger ? 'burger active' : 'burger'">
    <section class="burger_menu">
        <div></div>
        <div></div>
        <div></div>
    </section>
    Меню
</div>
<nav class="navbar_nav">
    <div
            :class="burger ? 'menu-background dark' : 'menu-background'"
    >
        <div :class="burger ? 'navbar_ul active' : 'navbar_ul'">
            @foreach($navbar_categories as $category_slug => $category_name)
                @if(isset($categories[$category_slug]))
                    <li x-data="{modal: false}" class="navbar_liservices" x-on:click="() => modal = !modal">
                        {{ $category_name }}
                        <div class="navbar_vector">
                            <img
                                style="transition: transform 0.3s ease"
                                x-bind:style="{transform: modal ? 'rotate(0deg)' : 'rotate(180deg)'}"
                                src="{{ a('images/vectordown.svg') }}"
                                alt=""
                            >
                        </div>
                    </li>

                    {{--                {showModal && <Categories categories={categories}/>}                --}}
                    <a href="/services">
                        <li class="navbar_limob">
                            {{ $category_name }}
                            <div class="navbar_right">
                                <img src="{{ a('images/bxs_chevron-right.svg') }}" alt="">
                            </div>
                        </li>
                    </a>
                @endif
            @endforeach

            @foreach($navbar_links as $link => $name)
                <a href="{{ $link }}">
                    <li class="navbar_li">
                        {{ $name }}
                        <div class="navbar_right">
                            <img src="{{ a('images/bxs_chevron-right.svg') }}" alt="">
                        </div>
                    </li>
                </a>
            @endforeach

            <div class="navbar_navcontainer">
                <div class="navbar_container_medium">
                    <img src="{{ a('images/gg_phone.svg') }}" alt="phone" class="navbar_phone"/>
                    <div class="navbar_container_small">
                        <p class="navbar_number">{{ $properties['phone'] }}</p>
                        <p class="navbar_timevisit">Ежедневно с 8:00 до 22:00</p>
                    </div>
                </div>
                <a
                        class="navbar_link"
                        href="https://t.me/{{ get_only_numbers($properties['phone']) }}"
                        target="_blank"
                        rel="noreferrer"
                >
                    <img src="{{ a('images/telegram.svg') }}" alt="Telegram" class="navbar_telegram"/>
                </a>
                <a
                        class="navbar_link"
                        href="https://api.whatsapp.com/send?phone={{get_only_numbers($properties['whatsapp'])}}&text=%D0%94%D0%BE%D0%B1%D1%80%D0%BE%D0%B3%D0%BE%20%D0%B2%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D0%B8%20%D1%81%D1%83%D1%82%D0%BE%D0%BA!"
                        target="_blank"
                        rel="noreferrer"
                >
                    <img src="{{ a('images/whatsapp.svg') }}" alt="WhatsApp" class="navbar_whatsapp"/>
                </a>
            </div>
        </div>
    </div>
</nav>
