import style from "./director.module.scss";
import WorkHistory from "../../../../images/work-history.svg";
import Vectorright from "../../../assets/svg/Vectorright.jsx";
import Popup from "../../popup/popup.jsx";
import SecondModal from "../../modal/second.jsx";
import {useState} from "react";
import parse from "html-react-parser";

export default function Director({content, properties}) {
    const [buttonPopup, setButtonPopup] = useState(false);

    return (
        <>
            <Popup trigger={buttonPopup} setTrigger={setButtonPopup}>
                <SecondModal properties={properties} HowToReachUs={true}/>
            </Popup>
            <section className={style.container}>
                <div className={style.backgroundsmall}></div>
                <div className={style.blok}>
                    <div className={style.about}>
                        <p className={style.title}>Руководитель детективного агентства</p>
                        <h3 className={style.h3}>{ content.name }</h3>
                    </div>
                    <div className={style.text}>{parse(content.about)}</div>
                    <div className={style.containerwork}>
                        <img src={WorkHistory} alt="work-history"/>
                        <p className={style.p}>{ content.experience }</p>
                    </div>
                    <button
                        type="submit"
                        className={style.button}
                        onClick={() => setButtonPopup(true)}
                    >
                        Записаться на консультацию
                        <div className={style.vector}>
                            <Vectorright/>
                        </div>
                    </button>
                </div>
                <div className={style.background}></div>
            </section>
        </>
    );
}
