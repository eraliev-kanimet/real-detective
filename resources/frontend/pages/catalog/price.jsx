import React, {useEffect, useState} from "react";
import AppLayout from "../../layouts/app.jsx";
import style from "../../assets/pages/catalog/price.module.scss";
import Breadcrumbs from "../../components/breadcrumbs/breadcrumbs.jsx";
import Table from "../../components/catalog/prices/prices.jsx";
import PriceMobile from "../../components/catalog/prices-mobile/prices-mobile.jsx";
import CategoryTab from "../../components/catalog/tab.jsx";

function CatalogPrice(props) {
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
            <section className={style.price_header}>
                <Breadcrumbs links={[{last: true, name: 'Цены'}]}/>
                <h1 className={style.h1}>цены на услуги детективного агентства</h1>
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
            <section className={style.container}>
                {items.map(item => (
                    <div key={item.id}>
                        <h2 className={style.h2}>{item.name}</h2>
                        <Table items={item.subcategories}/>
                    </div>
                ))}
            </section>
            <section className={style.container_mobile}>
                {items.map(item => (
                    <div key={item.id}>
                        <h2 className={style.h2}>{item.name}</h2>
                        <PriceMobile items={item.subcategories}/>
                    </div>
                ))}
            </section>
        </AppLayout>
    );
}

export default CatalogPrice;
