import style from "./how-to-reach-us.module.scss"
import { ReactComponent as Telegram } from "../../../../images/footer-telegram.svg";
import { ReactComponent as WhatsApp } from "../../../../images/popup-whatsapp.svg";
import { ReactComponent as Phone } from "../../../../images/popup-phone.svg";
import Form from "../form.jsx";

export default function HowToReachUs({properties, onButtonClickShow}) {
    return (
        <div className={style.reach_us_wrapper}>

            <h4 className={style.reach_us_title}>
                Как с нами связаться?
            </h4>
            <section>
                <p>Анонимно в мессенджерах или по телефону с руководителем</p>
                <div className={style.reach_us_links}>
                    <a
                        className={style.reach_us_link}
                        href={'https://t.me/' + properties.telegram}
                        target="_blank"
                        rel="noreferrer"
                    >
                        <Telegram />
                    </a>
                    <a
                        className={style.reach_us_link}
                        href={`https://api.whatsapp.com/send?phone=${properties.whatsapp.replace(/\D/g, '')}&text=%D0%94%D0%BE%D0%B1%D1%80%D0%BE%D0%B3%D0%BE%20%D0%B2%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D0%B8%20%D1%81%D1%83%D1%82%D0%BE%D0%BA!`}
                        target="_blank"
                        rel="noreferrer"
                    >
                        <WhatsApp />
                    </a>
                    <a
                        className={style.reach_us_link}
                        href={'tel:' + properties.phone.replace(/\D/g, '')}
                    >
                        <Phone />
                        <p>{properties.phone}</p>
                    </a>
                </div>
            </section>
            <section>
                <p>Или оставить заявку. Мы перезвоним вам в ближайшее время</p>
                <Form isPopup={true} onButtonClick={onButtonClickShow} isOnMain={false} />
            </section>
        </div>
    )
}
