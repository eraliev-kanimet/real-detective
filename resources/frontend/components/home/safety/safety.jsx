import style from "./safety.module.scss";
import parse from "html-react-parser";

export default function Safety({content}) {
    return (
        <section className={style.container}>
            <h3 className={style.h3}>{content.header}</h3>
            <div className={style.blok}>
                {parse(content.description)}
            </div>
        </section>
    );
}
