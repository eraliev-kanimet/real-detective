import style from "./popup.module.scss"
import {ReactComponent as Cross} from "../../assets/images/icon-white-cross.svg";
import Logo from "../../assets/images/logo.svg";

export default function Popup(props) {
    const checkOnGrey = (e) => {
        return e.target.className === style.popup ? props.setTrigger(false) : "";
    }

    return (props.trigger) ? (
        <div className={style.popup} onClick={(e) => checkOnGrey(e)}>
            <div className={style.popup_inner}>
                <div className={style.popup_header}>
                    <button className={style.close_btn} onClick={() => props.setTrigger(false)}><Cross/>Закрыть
                    </button>
                    <a href="/" className={style.popup_logo}>
                        <img src={Logo} alt="logo" className={style.popup_img}/>
                    </a>
                </div>
                {props.children}
            </div>
        </div>
    ) : ""
}
