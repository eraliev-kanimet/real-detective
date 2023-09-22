import React, {useRef, useLayoutEffect} from "react";

import Navbar from "../navbar/navbar.jsx";
import Logo from "../../../assets/images/logo.svg";
import Phone from "../../../assets/images/phone.svg";
import Telegram from "../../../assets/images/telegram.svg";
import WhatsApp from "../../../assets/images/whatsapp.svg";
import style from "./header.module.scss";
import "./sticky.scss";

function Header({properties, categories}) {
    const headerRef = useRef();

    useLayoutEffect(() => {
        const handleScroll = () => {
            const headerElement = headerRef.current;
            const isSticky = window.scrollY > headerElement.offsetTop;

            if (isSticky) {
                headerElement.classList.add("sticky");
            } else {
                headerElement.classList.remove("sticky");
            }
        };

        window.addEventListener("scroll", handleScroll);

        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, []);

    return (
        <>
            <header ref={headerRef}>
                <div className={style.header}>
                    <a href="/">
                        <img src={Logo} alt="logo" className={style.logo}/>
                    </a>
                    <Navbar properties={properties} categories={categories}/>
                    <div className={style.container}>
                        <div className={style.container_medium}>
                            <img src={Phone} alt="phone"/>
                            <div className={style.container_small}>
                                <p className={style.number}>{ properties.phone }</p>
                                <p className={style.timevisit}>Ежедневно с 8:00 до 22:00</p>
                            </div>
                        </div>
                        <a
                            href={'https://t.me/' + properties.telegram}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <img src={Telegram} alt="Telegram" className={style.telegram}/>
                        </a>
                        <a
                            href={`https://api.whatsapp.com/send?phone=${properties.whatsapp.replace(/\D/g, '')}&text=%D0%94%D0%BE%D0%B1%D1%80%D0%BE%D0%B3%D0%BE%20%D0%B2%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D0%B8%20%D1%81%D1%83%D1%82%D0%BE%D0%BA!`}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <img src={WhatsApp} alt="WhatsApp" className={style.whatsapp}/>
                        </a>
                    </div>
                </div>
            </header>
        </>
    );
}

export default Header;
