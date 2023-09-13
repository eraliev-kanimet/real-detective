import style from "../assets/pages/not_found.module.scss";
import {ReactComponent as VectorRight} from "../../images/vectorright.svg";
import NoMatch from "../../images/nomatch-404.png";
import AppLayout from "../layouts/app.jsx";

function NotFound(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div className={style.container}>
                <div className={style.blok_nomatch}>
                    <h1 className={style.h1}>404. Страница не найдена</h1>
                    <p className={style.p}>
                        Возможно, она была перемещена, или вы просто
                        <br/> неверно указали адрес страницы.
                    </p>
                    <a href="/">
                        <button className={style.button_nomatch} type="button">
                            Перейти на главную
                            <VectorRight alt="vector" className={style.icon_nomatch}/>
                        </button>
                    </a>
                </div>
                <img src={NoMatch} alt="404_page" className={style.img_nomatch}/>
            </div>
        </AppLayout>
    );
}

export default NotFound;
