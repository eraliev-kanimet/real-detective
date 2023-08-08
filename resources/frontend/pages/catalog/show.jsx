import AppLayout from "../../layouts/app.jsx";
import style from "../../assets/pages/catalog/show.module.scss";
import {useEffect, useState} from "react";
import Breadcrumbs from "../../components/breadcrumbs/breadcrumbs.jsx";
import Star from "../../assets/images/icon_star.svg";
import {ReactComponent as VectorRight} from "../../assets/images/vectorright.svg";
import {ReactComponent as Binoculars} from "../../assets/images/services-binoculars.svg";
import FAQ from "../../components/faq/faq.jsx";
import Blog from "../../components/home/blog/blog.jsx";
import Popup from "../../components/popup/popup.jsx";
import SecondModal from "../../components/modal/second.jsx";
import parse from "html-react-parser";

function CatalogShow(props) {
    const [category, setCategory] = useState({
        basic: {},
        video: {},
        rating_array: [],
        related: [],
        content: [],
    })

    useEffect(() => {
        if (Object.keys(props.category?.data).length) {
            setCategory(props.category.data)
        }
    }, [props]);
    const [buttonPopup, setButtonPopup] = useState(false);

    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <Popup trigger={buttonPopup} setTrigger={setButtonPopup}>
                <SecondModal properties={props.properties} HowToReachUs={true}/>
            </Popup>

            <main className={style.container}>
                <section className={style.section_header}>
                    <Breadcrumbs
                        links={[{url: '/catalog', name: 'Каталог'}, {last: true, name: category.name}]}
                    />
                    <h1 className={style.h1}>{category.basic.h1}</h1>
                    <div className={style.blok_header}>
                        <a
                            href={category.video.url}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <img
                                src={category.video.image}
                                alt="geolocation"
                                className={style.img}
                            />
                        </a>
                        <div className={style.blok_header_text}>
                            <p className={style.text_header}>{category.description}</p>
                            <div className={style.blok_price}>
                                <div className={style.blok_pricesmall}>
                                    <p className={style.text_aboutprice}>Минимальный депозит</p>
                                    <p className={style.text_price}>{category.minimum_advance_amount} руб</p>
                                </div>
                                <div className={style.blok_pricesmall}>
                                    <p className={style.text_aboutprice}>Средний чек</p>
                                    <p className={style.text_price}>{category.average_receipt} руб</p>
                                </div>
                            </div>
                            <div className={style.blok_buy}>
                                <button
                                    onClick={() => setButtonPopup(true)}
                                    className={style.button_buy}
                                    type="button"
                                >
                                    Заказать услугу
                                    <VectorRight alt="vector" className={style.icon}/>
                                </button>

                                <div className={style.blokmobile_rating}>
                                    <p className={style.text_rating}>{category.rating}</p>
                                    <div className={style.blok_star}>
                                        {category.rating_array.map((rating, index) => <img key={index} src={Star}
                                                                                           alt="star"/>)}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section className={style.section_main}>
                    {category.content.map((content, index) => (
                        <div key={index} className={style.blok_main}>
                            <h2 className={style.h2}>{content.header}</h2>
                            {parse(content.content)}
                        </div>
                    ))}

                    <div className={style.blok_main2}>
                        <h2 className={style.h2}>Этапы нашей работы</h2>
                        <div className={style.about}>
                            <div className={style.blok}>
                                <p className={style.number}>1</p>
                                <p className={style.title}>Заявка на услугу</p>
                                <p className={style.smalltext}>
                                    Оставляете заявку любым удобным способом
                                </p>
                            </div>
                            <div className={style.blok}>
                                <p className={style.number}>2</p>
                                <p className={style.title}>Консультация</p>
                                <p className={style.smalltext}>
                                    Бесплатная консультация и обсуждение деталей
                                </p>
                            </div>
                            <div className={style.blok}>
                                <p className={style.number}>3</p>
                                <p className={style.title}>Предоплата</p>
                                <p className={style.smalltext}>
                                    После обсуждения деталей - внесение предоплаты
                                </p>
                            </div>
                            <div className={style.blok}>
                                <p className={style.number}>4</p>
                                <p className={style.title}>Выполнение</p>
                                <p className={style.smalltext}>
                                    Переходим к выполнению поставленных задач
                                </p>
                            </div>
                            <div className={style.blok}>
                                <p className={style.number}>5</p>
                                <p className={style.title}>Отчет</p>
                                <p className={style.smalltext}>
                                    Предоставление полного отчета о проделанной работе
                                </p>
                            </div>
                        </div>
                    </div>

                    {category.related.length ? (
                        <div className={style.blok_main}>
                            <h2 className={style.h2}>Похожие услуги</h2>
                            {category.related.map(related => (
                                <a href={'/catalog/' + related.slug} key={related.id}>
                                    <div className={style.button_yet}>
                                        <div className={style.smallcontainer_yet}>
                                            <Binoculars alt="Binoculars" className={style.iconbutton}/>
                                            <p className={style.button_text}>{related.name}</p>
                                        </div>
                                        <p className={style.button_price}>От {related.minimum_advance_amount} руб</p>
                                    </div>
                                </a>
                            ))}
                        </div>
                    ) : ''}
                </section>
                <FAQ faq={category.faq ?? []} content={props.content.block3}/>
                <Blog header='Блог' articles={props.articles?.data ?? []}/>
            </main>
        </AppLayout>
    );
}

export default CatalogShow;
