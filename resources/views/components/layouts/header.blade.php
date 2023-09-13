<header>
    <div class="header_header">
        <a href="/">
            <img src="{{ a('images/logo.svg') }}" alt="logo" class=logo/>
        </a>
            @include('components.layouts.navbar')
            <div class="header_container">
                <div class="header_container_medium">
                    <img src="{{ a('images/phone.svg') }}" alt="phone" class="header_phone"/>
                    <div class="header_container_small">
                        <p class="header_number">{{ $properties['phone'] }}</p>
                        <p class="header_timevisit">Ежедневно с 8:00 до 22:00</p>
                    </div>
                </div>
                <a
                    href="https://t.me/{{ get_only_numbers($properties['phone']) }}"
                    target="_blank"
                    rel="noreferrer"
                >
                    <img src="{{ a('images/telegram.svg') }}" alt="Telegram" class="header_telegram"/>
                </a>
                <a
                    href="https://api.whatsapp.com/send?phone={{get_only_numbers($properties['whatsapp'])}}&text=%D0%94%D0%BE%D0%B1%D1%80%D0%BE%D0%B3%D0%BE%20%D0%B2%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D0%B8%20%D1%81%D1%83%D1%82%D0%BE%D0%BA!"
                    target="_blank"
                    rel="noreferrer"
                >
                    <img src="{{ a('images/whatsapp.svg') }}" alt="WhatsApp" class="header_whatsapp"/>
                </a>
            </div>
    </div>
</header>
