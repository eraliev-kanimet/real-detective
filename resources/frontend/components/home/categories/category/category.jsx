import style from "./category.module.scss";
import Foot from "../../../../assets/svg/subcategory/icon_foot.svg";
import Head from "../../../../assets/svg/subcategory/icon_head.svg";
import Camera from "../../../../assets/svg/subcategory/icon_camera.svg";

export default function Category({category}) {
    const icons = {
        foot: Foot,
        head: Head,
        camera: Camera,
    }

    return (
        <div className={style.card}>
            <img src={icons[category.icon]} className={style.card_icon} alt=""/>
            <a href={'/catalog/' + category.slug}>
                <p className={style.card_title}>{ category.name }</p>
            </a>
            <p className={style.card_text}>{ category.basic.description }</p>
            <div className={style.card_price_container}>
                <p className={style.card_price}>от {category.minimum_advance_amount} руб</p>
                <a href={'/catalog/' + category.slug}>
                    <div>
                        <span>Подробнее</span>
                        <img
                            src={"/images/biege_arrow_right.svg"}
                            alt="Нажмите, чтобы узнать подробнее"
                        />
                    </div>
                </a>
            </div>
        </div>
    );
}
