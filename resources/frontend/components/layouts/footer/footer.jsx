import style from "./footer.module.scss";

import Logo from "../../../assets/images/logo.svg";
import Telegram from "../../../assets/images/footer-telegram.svg";
import Techat from "../../../assets/images/footer-techat.svg";
import Youtube from "../../../assets/images/footer-youtube.svg";
import Profi from "../../../assets/images/footer-profi.svg";
import Location from "../../../assets/images/footer-location.svg";
import Phone from "../../../assets/images/footer-phone.svg";
import Time from "../../../assets/images/footer-time.svg";
import Email from "../../../assets/images/footer-email.svg";
import Mir from "../../../assets/images/footer-mir.png";
import Visa from "../../../assets/images/footer-visa.png";
import Mastercard from "../../../assets/images/footer-mastercard.png";
import {LazyLoadImage} from "react-lazy-load-image-component";

export default function Footer({properties, categories}) {
    return (
        <footer className={style.container}>
            <div className={style.blokheader}>
                <img src={Logo} alt="logo" className={style.logo}/>
                <div className={style.bloksocnet}>
                    <p className={style.p}>Мы в социальных сетях</p>

                    <div className={style.blokmobile}>
                        <a
                            className={style.bloknet}
                            href={'https://t.me/' + properties.telegram}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Telegram} alt="Telegram" className={style.socnet}/>
                        </a>

                        <a
                            className={style.bloknet2}
                            href={properties.tenchat}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Techat} alt="Techat" className={style.socnet}/>
                        </a>

                        <a
                            className={style.bloknet}
                            href={properties.youtube}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Youtube} alt="Videos" className={style.socnet}/>
                        </a>

                        <a
                            className={style.bloknet}
                            href={properties.profi}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Profi} alt="Profi" className={style.socnet}/>
                        </a>
                    </div>
                </div>
            </div>

            <div className={style.blokmain}>
                <div className={style.blokmain1}>
                    <div className={style.contact}>
                        <p className={style.title}>Контакты</p>

                        <div className={style.section}>
                            <LazyLoadImage src={Location} alt="Location" className={style.icon}/>
                            <p className={style.p}>{properties.address}</p>
                        </div>

                        <div className={style.section}>
                            <LazyLoadImage src={Phone} alt="Phone" className={style.icon}/>
                            <p className={style.p}>{properties.phone}</p>
                        </div>

                        <div className={style.section}>
                            <LazyLoadImage src={Time} alt="Time" className={style.icon}/>
                            <p className={style.p}>Понедельник-суббота 8:00-18:00</p>
                        </div>

                        <div className={style.section}>
                            <LazyLoadImage src={Email} alt="Email" className={style.icon}/>
                            <p className={style.p}>{properties.email}</p>
                        </div>
                    </div>

                    <div className={style.card}>
                        <LazyLoadImage src={Mir} alt="Mir" className={style.cardicon}/>
                        <LazyLoadImage src={Visa} alt="Visa" className={style.cardicon}/>
                        <LazyLoadImage
                            src={Mastercard}
                            alt="Mastercard"
                            className={style.cardicon}
                        />
                    </div>
                </div>

                {
                    categories.private_person ? <div className={style.blokmain3}>
                        <p className={style.title}>Для частных лиц</p>
                        {
                            categories.private_person.map(category => (
                                <a href="/services" key={category.id}>
                                    <p className={style.p}>{ category.name }</p>
                                </a>
                            ))
                        }
                    </div> : ''
                }

                {
                    categories.business ? <div className={style.blokmain2}>
                        <p className={style.title}>Для бизнеса</p>
                        {
                            categories.business.map(category => (
                                <a href="/services" key={category.id}>
                                    <p className={style.p}>{ category.name }</p>
                                </a>
                            ))
                        }
                    </div> : ''
                }

                <div className={style.blokmain4}>
                    <p className={style.title}>Меню</p>
                    <a href="/blog">
                        <p className={style.p}>Блог</p>
                    </a>
                    <a href="/reviews">
                        <p className={style.p}>Отзывы</p>
                    </a>
                    <a href="/contacts">
                        <p className={style.p}>Контакты</p>
                    </a>
                    <a href="/services">
                        <p className={style.p}>Услуги</p>
                    </a>
                    <a href="/price">
                        <p className={style.p}>Цены</p>
                    </a>
                </div>
            </div>

            <div className={style.blokfooter}>
                <p className={style.p}>
                    © 2023 PERSIN & PARTNERS. Все права защищены
                </p>
                <div className={style.politic}>
                    <a href="/privacy-policy">
                        <p className={style.p}>Политика конфиденциальности</p>
                    </a>
                    <a href="/cookies-policy">
                        <p className={style.p}>Политика использования Cookies</p>
                    </a>
                    <a href="/sitemap">
                        <p className={style.p}>Карта сайта</p>
                    </a>
                </div>
            </div>
        </footer>
    );
}
