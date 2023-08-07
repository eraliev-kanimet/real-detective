import React, {useEffect, useState} from "react";
import style from "../../assets/pages/catalog/index.module.scss";
import Breadcrumbs from "../../components/breadcrumbs/breadcrumbs.jsx";
import {ReactComponent as Info} from "../../assets/images/services-chat.svg";
import {ReactComponent as Family} from "../../assets/images/services-family.svg";
import {ReactComponent as Binoculars} from "../../assets/images/services-binoculars.svg";
import {ReactComponent as Search} from "../../assets/images/services-search.svg";
import {ReactComponent as Protect} from "../../assets/images/services-protect.svg";
import {ReactComponent as Journalism} from "../../assets/images/services-journalism.svg";
import {ReactComponent as ArrowDown} from "../../assets/images/biege_arrow_down.svg";
import AppLayout from "../../layouts/app.jsx";
import CategoryTab from "../../components/catalog/tab.jsx";

function CatalogIndex(props) {
    const [category, setCategory] = useState('')
    const [items, setItems] = useState([])

    useEffect(() => {
        setCategoryItems(props.categories.hasOwnProperty('private_person') ? 'private_person' : 'business')
    }, [props])

    const setCategoryItems = (key) => {
        setCategory(key)
        setItems(props.categories[key] ?? [])
    }

    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div>
                <section className={style.section_header}>
                    <Breadcrumbs links={[{last: true, name: 'Услуги'}]}/>
                    <h1 className={style.h1}>Услуги</h1>
                    <div className={style.services__tabs}>
                        {
                            props.categories.hasOwnProperty('private_person') ? (
                                <CategoryTab
                                    onClick={() => setCategoryItems('private_person')}
                                    current={category}
                                    category='private_person'
                                    categoryName='Для частных лиц'
                                />
                            ) : ''
                        }
                        {
                            props.categories.hasOwnProperty('business') ? (
                                <CategoryTab
                                    onClick={() => setCategoryItems('business')}
                                    current={category}
                                    category='business'
                                    categoryName='Для бизнеса'
                                />
                            ) : ''
                        }
                    </div>
                </section>
                <section className={style.catalog}>
                    {items.map(subcategory => (
                        <Category key={subcategory.id} category={subcategory}/>
                    ))}
                </section>
                <section className={style.catalog_mobile}>
                    {items.map(subcategory => (
                        <CategoryMobile key={subcategory.id} category={subcategory}/>
                    ))}
                </section>
            </div>
        </AppLayout>
    );
}

const Category = ({category}) => {
    const icons = {
        info: <Info alt="Info" className={style.img}/>,
        family: <Family alt="Family" className={style.img}/>,
        binoculars: <Binoculars alt="Binoculars" className={style.img}/>,
        search: <Search alt="Search" className={style.img}/>,
        protect: <Protect alt="Protect" className={style.img}/>,
        journalism: <Journalism alt="Journalism" className={style.img}/>,
        default: <Info alt="Info" className={style.img}/>,
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
                <a key={item.id} href={'/catalog/' + item.slug}>
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

const CategoryMobile = ({category}) => {
    const [showItems, setShowItems] = useState(false);

    const icons = {
        info: <Info
            alt="Info"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        family: <Family
            alt="Family"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        binoculars: <Binoculars
            alt="Binoculars"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        search: <Search
            alt="Search"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        protect: <Protect
            alt="Protect"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        journalism: <Journalism
            alt="Journalism"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
        default: <Info
            alt="Info"
            className={style.img}
            style={{
                filter: showItems
                    ? "brightness(0%) saturate(100%)"
                    : "none",
                transitionDuration: "0.2s",
            }}
        />,
    }

    const getIcon = (icon) => {
        if (icons.hasOwnProperty(icon)) {
            return icons[icon]
        }

        return icons.default
    }

    return (
        <div className={style.blok}>
            <div className={style.row}>
                <div className={style.bloksmall}>
                    {getIcon(category.icon)}
                    <h2 className={style.h2}>{category.name}</h2>
                </div>
                <ArrowDown
                    onClick={() => setShowItems(!showItems)}
                    style={{
                        transform: showItems ? "rotate(180deg)" : "rotate(0deg)",
                        transition: "transform 0.3s ease",
                    }}
                />
            </div>
            {showItems && (
                <div className={style.bloktext}>
                    {category.subcategories.map(subcategory => (
                        <a key={subcategory.id} href={'/catalog/' + subcategory.slug}>
                            <p className={style.text}>{subcategory.name}</p>
                        </a>
                    ))}
                </div>
            )}
        </div>
    );
};

export default CatalogIndex;
