import React, {useState} from 'react';
import style from "./categories.module.scss";
import {ReactComponent as Info} from "../../../../assets/images/services-chat.svg";
import {ReactComponent as Family} from "../../../../assets/images/services-family.svg";
import {ReactComponent as Binoculars} from "../../../../assets/images/services-binoculars.svg";
import {ReactComponent as Search} from "../../../../assets/images/services-search.svg";
import {ReactComponent as Protect} from "../../../../assets/images/services-protect.svg";
import {ReactComponent as Journalism} from "../../../../assets/images/services-journalism.svg";

const Subcategories = ({category}) => {
    const icons = {
        info: <Info alt="Info"/>,
        family: <Family alt="Family"/>,
        binoculars: <Binoculars alt="Binoculars"/>,
        search: <Search alt="Search"/>,
        protect: <Protect alt="Protect"/>,
        journalism: <Journalism alt="Journalism"/>,
        default: <Info alt="Info"/>,
    }

    const getIcon = (icon) => {
        if (icons.hasOwnProperty(icon)) {
            return icons[icon]
        }

        return icons.default
    }

    const [visibleItems, setVisibleItems] = useState(5);

    const showMoreItems = () => {
        setVisibleItems(prevVisibleItems => prevVisibleItems + 5);
    };

    return (
        <section>
            {getIcon(category.icon)}
            <h2 className={style.h2}>{category.name}</h2>
            {category.subcategories.slice(0, visibleItems).map(item => (
                <a key={item.id} href={'/services/' + item.slug}>
                    <p className={style.text}>{item.name}</p>
                </a>
            ))}
            {visibleItems < category.subcategories.length ? (
                <button className={style.button} onClick={showMoreItems}>
                    Ещё {category.subcategories.slice(5).length}
                </button>
            ) : (
                category.subcategories.length > 5 ? (
                    <button className={style.button} onClick={() => setVisibleItems(5)}>Скрыть</button>
                ) : null
            )}
        </section>
    );
};

export default Subcategories;
