import style from "./how-to-reach-us.module.scss"
import { ReactComponent as Telegram } from "../../../assets/images/footer-telegram.svg";
import { ReactComponent as WhatsApp } from "../../../assets/images/popup-whatsapp.svg";
import { ReactComponent as Phone } from "../../../assets/images/popup-phone.svg";
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
                        href={properties.telegram}
                        target="_blank"
                        rel="noreferrer"
                    >
                        <Telegram />
                    </a>
                    <a
                        className={style.reach_us_link}
                        href={properties.whatsapp}
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
