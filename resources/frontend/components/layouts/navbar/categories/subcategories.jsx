import React, {useState} from 'react';
import style from "./categories.module.scss";

const Subcategories = ({category}) => {
    const [visibleItems, setVisibleItems] = useState(5);

    const showMoreItems = () => {
        setVisibleItems(prevVisibleItems => prevVisibleItems + 5);
    };

    return (
        <section>
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
