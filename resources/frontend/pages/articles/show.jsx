import React, {useState, useEffect} from "react";
import Blog from "../../components/home/blog/blog.jsx";
import {Carousel} from "../../components/articles/carousel/carousel.jsx";
import style from "../../assets/pages/articles/show.module.scss";
import Breadcrumbs from "../../components/breadcrumbs/breadcrumbs.jsx";
import Eye from "../../assets/images/article-eye.svg";
import {ReactComponent as VectotUp} from "../../assets/images/article-icon.svg";
import Fire from "../../assets/images/article-fire.svg";
import Car from "../../assets/images/article-car.svg";
import Cat from "../../assets/images/article-cat.svg";
import Quote from "../../assets/images/article-quote.svg";
import Info from "../../assets/images/article-info.svg";
import Like from "../../assets/images/article-like.svg";
import Dislike from "../../assets/images/article-dislike.svg";
import Telegram from "../../assets/images/footer-telegram.svg";
import Whatsapp from "../../assets/images/article-whatsapp.svg";
import Vk from "../../assets/images/article-vk.svg";
import Fc from "../../assets/images/article-facebook.svg";
import AppLayout from "../../layouts/app.jsx";
import FaqItem from "../../components/faq/faq-item.jsx";
import "../../components/faq/faq.scss";
import axios from "axios";
import {LazyLoadImage} from "react-lazy-load-image-component";

function ArticlesShow(props) {
    const [article, setArticle] = useState({
        id: '',
        name: '',
        description: '',
        image: '',
        date: '',
        faq: [],
        author: {},
        read_time: '',
        content: [],
        rating: 0,
        views: 0,
        likes: 0,
        dislikes: 0,
    })
    const [showItems, setShowItems] = useState(false);
    const [isIconUp, setIsIconUp] = useState(false);
    const [views, setViews] = useState(0);
    const [liked, setLiked] = useState(false);
    const [disliked, setDisliked] = useState(false);

    useEffect(() => {
        if (Object.keys(props.article?.data).length) {
            setArticle(props.article.data)

            setLiked(localStorage.getItem('article_liked' + article.id) === 'true');
            setDisliked(localStorage.getItem('article_disliked' + article.id) === 'true');
            setViews(article.views)

            if (article.rating) {
                setTimeout(() => {
                    axios.get('/api/rating/views/' + article.rating).then(() => {
                        setViews(Number(article.views) + 1)
                    })
                }, 5000)
            }
        }
    }, [props]);

    const updateLocalStorage = async (key, value, data) => {
        if (value) {
            localStorage.setItem(key, 'true');
        } else {
            localStorage.removeItem(key);
        }

        return await axios.post('/api/rating/likes_or_dislikes', {
            rating: article.rating,
            likes: data.likes,
            dislikes: data.dislikes,
        }).then(() => {
            setArticle({...article, likes: data.likes, dislikes: data.dislikes});
        })
    };

    const likeHandle = async () => {
        let likes = article.likes
        let dislikes = article.dislikes

        if (liked) {
            likes--;
        } else {
            likes++;
            if (disliked) {
                dislikes--;
                setDisliked(false);
                localStorage.removeItem('article_disliked' + article.id)
            }
        }

        setLiked(!liked);
        await updateLocalStorage('article_liked' + article.id, !liked, {
            likes: likes,
            dislikes: dislikes,
        }).then();
    };

    const dislikeHandle = async () => {
        let likes = article.likes
        let dislikes = article.dislikes

        if (disliked) {
            dislikes--;
        } else {
            dislikes++;

            if (liked) {
                likes--
                setLiked(false);
                localStorage.removeItem('article_liked' + article.id)
            }
        }

        setDisliked(!disliked);
        await updateLocalStorage('article_disliked' + article.id, !disliked, {
            likes: likes,
            dislikes: dislikes,
        }).then();
    };

    const handleItemClick = () => {
        setShowItems(!showItems);
        setIsIconUp(!isIconUp);
    };

    const scrollToSection = (sectionId, e) => {
        e.stopPropagation()
        document.getElementById(sectionId)
            .scrollIntoView({behavior: "smooth", block: 'center', inline: 'nearest'});
    };

    const icons = {
        fire: Fire,
        car: Car,
        cat: Cat,
        default: Cat,
    }

    const getIcons = (name) => {
        return icons[name] ?? icons.default
    }

    return (<AppLayout properties={props.properties} categories={props.categories}>
        <div className={style.container}>
            <section className={style.section_header}>
                <Breadcrumbs links={[{url: '/blog', name: 'Блог'}, {last: true, name: article.name}]}/>
                <img src={article.image} alt="article main" className={style.image}/>
                <div className={style.container_time}>
                    <div className={style.blok_time}>
                        <p className={style.time}>Читать {article.read_time} минут</p>
                        <img src={Eye} alt="eye"/>
                        <p className={style.time}>{views}</p>
                    </div>
                    <p className={style.time}>{article.date}</p>
                </div>
                <h1 className={style.h1}>{article.name}</h1>
                <p className={style.text}>{article.description}</p>
                <div className={style.blok}>
                    <div className={style.row}>
                        <h3 className={style.h3}>Содержание</h3>
                        <VectotUp
                            alt="VectotUp"
                            className={style.large_icon}
                            onClick={handleItemClick}
                            style={{
                                transform: isIconUp ? "rotate(0deg)" : "rotate(180deg)",
                                transition: "transform 0.3s ease",
                            }}
                        />
                    </div>
                    {showItems && (
                        <ol className={style.bloktext}>
                            {article.content.map((content, index) => {
                                if (['text_with_headers_type_1'].includes(content.type)) {
                                    return (
                                        <li
                                            key={index}
                                            onClick={(e) => scrollToSection('title' + index, e)}
                                        >{content.data.header}</li>
                                    )
                                }

                                if (['text_with_headers_type_2', 'text_with_headers_type_3'].includes(content.type)) {
                                    return (
                                        <li
                                            key={index}
                                            onClick={(e) => scrollToSection('title' + index, e)}
                                        >
                                            <div style={{marginBottom: '8px'}}>{content.data.header}</div>
                                            <ol className={style.bloktext}>
                                                {content.data.items.map((item, index2) => (
                                                    <li
                                                        key={index2}
                                                        onClick={(e) => scrollToSection(index2 + 'subtitle' + index, e)}
                                                    >{item.header}</li>
                                                ))}
                                            </ol>
                                        </li>
                                    )
                                }
                            })}
                        </ol>
                    )}
                </div>
            </section>

            {article.content.map((content, index) => {
                if (content.type === 'text') {
                    return (
                        <section key={index} className={style.section_titletext}>
                            <p className={style.text}>{content.data.content}</p>
                        </section>
                    )
                }

                if (content.type === 'text_with_headers_type_1') {
                    return (
                        <section key={index} className={style.section_titletext}>
                            <h2 className={style.h2} id={'title' + index}>{content.data.header}</h2>
                            {content.data.items.map((item, index2) => {
                                if (item.type === 'text') {
                                    return (
                                        <div key={index2} className={style.blok_titletext}>
                                            <p className={style.text}>{item.data.content}</p>
                                        </div>
                                    )
                                }

                                if (item.type === 'subheader') {
                                    return (
                                        <div key={index2} className={style.blok_titletext}>
                                            <h3 className={style.h3}
                                                id={index2 + 'subtitle' + index}>{item.data.header}</h3>
                                            <p className={style.text}>{item.data.text}</p>
                                        </div>
                                    )
                                }
                            })}
                        </section>
                    )
                }

                if (content.type === 'text_with_headers_type_2') {
                    return (
                        <section key={index} className={style.section_tablesvg}>
                            <h2 className={style.h2} id={'title' + index}>{content.data.header}</h2>
                            <div className={style.about}>
                                {content.data.items.map((item, index3) => (
                                    <div key={index3} className={style.blokabout}>
                                        <LazyLoadImage src={getIcons(item.icon)} alt="Icon" className={style.img}/>
                                        <h3 className={style.title} id={index3 + 'subtitle' + index}>{item.header}</h3>
                                        <p className={style.smalltext}>{item.text}</p>
                                    </div>
                                ))}
                            </div>
                        </section>
                    )
                }

                if (content.type === 'text_with_headers_type_3') {
                    return (
                        <section key={index} className={style.section_titletext}>
                            <h2 className={style.h2} id={'title' + index}>{content.data.header}</h2>
                            <div className={style.numbers}>
                                {content.data.items.map((item, index4) => (
                                    <div key={index4} className={style.blok_numbers}>
                                        <p className={style.number}>{index4 + 1}</p>
                                        <h3 className={style.title_numbers}
                                            id={index4 + 'subtitle' + index}>{item.header}</h3>
                                        <p className={style.smalltext_numbers}>{item.text}</p>
                                    </div>
                                ))}
                            </div>
                        </section>
                    )
                }

                if (content.type === 'quote') {
                    return (
                        <section key={index} className={style.section_quote}>
                            <LazyLoadImage src={Quote} alt="Quote" className={style.img}/>
                            <div className={style.blok_quote}>
                                <p className={style.text}>{content.data.text}</p>
                                <div className={style.blokdirector}>
                                    <LazyLoadImage
                                        className={style.img64}
                                        src={'/storage/' + content.data.author.image}
                                        alt="director"
                                    />
                                    <p className={style.text}>
                                        {content.data.author.name}
                                        <br/>
                                        <span className={style.textdirector}>{content.data.author.post}</span>
                                    </p>
                                </div>
                            </div>
                        </section>
                    )
                }

                if (content.type === 'quote2') {
                    return (
                        <section key={index} className={style.section_gray}>
                            <LazyLoadImage src={Quote} alt="Quote" className={style.img}/>
                            <p className={style.text}>{content.data.text}</p>
                        </section>
                    )
                }

                if (content.type === 'info') {
                    return (
                        <section key={index} className={style.section_gray}>
                            <LazyLoadImage src={Info} alt="Info" className={style.img}/>
                            <p className={style.text}>{content.data.text}</p>
                        </section>
                    )
                }

                if (content.type === 'image') {
                    return (
                        <section key={index} className={style.section_titletext}>
                            {content.data.header ? (
                                <h2 className={style.h2}>{content.data.header}</h2>
                            ) : ''}
                            {content.data.images.length === 1 ? (
                                <div className={style.blok_titletext}>
                                    <LazyLoadImage
                                        src={'/storage/' + content.data.images[0].image}
                                        alt={content.data.images[0].alt}
                                        className={style.image}
                                    />
                                    <p className={style.text}>{content.data.text}</p>
                                </div>
                            ) : <Carousel>{
                                content.data.images.map(image => (
                                    <img
                                        key={image.image}
                                        src={'/storage/' + image.image}
                                        alt={image.alt}
                                        className={style.imageslider}
                                    />
                                ))
                            }</Carousel>}
                        </section>
                    )
                }
            })}

            <section className={style.section_question}>
                <h2 className={style.h2}>Ответы на популярные вопросы</h2>
                {article.faq.map((item, index) => <FaqItem key={index} content={item}/>)}
            </section>

            <section className={style.section_autor}>
                <LazyLoadImage className={style.img64} src={article.author.image} alt="director"/>
                <p className={style.textautor}>
                    Автор статьи
                    <br/>
                    <span className={style.textautordirector}>{article.author.name}</span>
                </p>
            </section>

            <section className={style.section_socnet}>
                <div className={style.button_socnet}>
                    <button
                        onClick={likeHandle}
                        type="button"
                        className={style.like}
                    >
                        <LazyLoadImage src={Like} alt="Like"/>
                        {article.likes}
                    </button>
                    <button
                        onClick={dislikeHandle}
                        type="button"
                        className={style.dislike}
                    >
                        <LazyLoadImage src={Dislike} alt="Dislike"/>
                        {article.dislikes}
                    </button>
                </div>
                <div className={style.bloksocnet}>
                    <p className={style.p}>Поделиться</p>

                    <div className={style.blokmobile}>
                        <a
                            className={style.bloknet}
                            href="https://t.me/"
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Telegram} alt="Telegram"/>
                        </a>

                        <a
                            className={style.bloknet}
                            href="https://api.whatsapp.com/"
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Whatsapp} alt="Whatsapp"/>
                        </a>

                        <a
                            className={style.bloknet}
                            href="https://vk.com/"
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Vk} alt="Vk"/>
                        </a>

                        <a
                            className={style.bloknet}
                            href="https://es-es.facebook.com/"
                            target="_blank"
                            rel="noreferrer"
                        >
                            <LazyLoadImage src={Fc} alt="Fc"/>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <Blog viewAll={false} header='Читайте также' articles={props.articles?.data ?? []}/>
        </div>
    </AppLayout>);
}

export default ArticlesShow;
