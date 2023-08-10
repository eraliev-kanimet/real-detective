import style from "./categories.module.scss";
import Category from "./category/category.jsx";
import Person from "../../../assets/images/icon_person.svg";
import Business from "../../../assets/images/icon_business.svg";
import Vectorright from "../../../assets/svg/Vectorright.jsx";
import {Splide, SplideSlide} from "@splidejs/react-splide";
import "@splidejs/react-splide/css";
import {useEffect, useState} from "react";

export default function Categories(props) {
    const [category, setCategory] = useState('')
    const [subcategories, setSubcategories] = useState([])

    useEffect(() => {
        setCategoryHandle(props.categories.private_person ? 'private_person' : 'business')
    }, [props.categories]);

    const setCategoryHandle = (key) => {
        setCategory(key)
        setSubcategories(getSubcategoriesWithIcons(props.categories[key]))
    }

    const getSubcategoriesWithIcons = (items) => {
        const icons = ['foot', 'head', 'camera'];

        let iconIndex = 0;

        const subcategoriesArray = items?.flatMap((itemGroup) =>
            itemGroup.subcategories.map((item) => {
                item.icon = icons[iconIndex];
                iconIndex = (iconIndex + 1) % icons.length;
                return item;
            })
        );

        return subcategoriesArray ?? [];
    };

    return (
        <>
            <section className={style.container}>
                <div className={style.services__header}>
                    <h3>Услуги</h3>
                    <ul>
                        {
                            props.categories.private_person ? (
                                <li onClick={() => setCategoryHandle('private_person')}
                                    className={category === 'private_person' ? style.services__person : ''}
                                >
                                    <img src={Person} alt="Person"></img>
                                    Для частных лиц
                                </li>
                            ) : ''
                        }
                        {
                            props.categories.business ? (
                                <li onClick={() => setCategoryHandle('business')}
                                    className={category === 'business' ? style.services__person : ''}
                                >
                                    <img src={Business} alt="Business"></img>
                                    Для бизнеса
                                </li>
                            ) : ''
                        }
                    </ul>
                    <a href="/services">
                        <button type="submit" className={style.button}>
                            Смотреть все
                            <div className={style.vector}>
                                <Vectorright/>
                            </div>
                        </button>
                    </a>
                </div>
                <Splide
                    options={{
                        perPage: 4,
                        breakpoints: {
                            1280: {
                                perPage: 3,
                            },
                            744: {
                                perPage: 2,
                                arrows: false,
                            },
                            480: {
                                perPage: 1,
                                height: 490,
                                gap: 16,
                                arrows: false,
                            },
                        },
                        perMove: 1,
                        rewind: true,
                        autoWidth: true,
                        height: 560,
                        pagination: false,
                        arrows: true,
                        type: "loop",
                        gap: 20,
                    }}
                    aria-label="Categories"
                    className={style.custom_splide}
                >
                    {subcategories.map(category => (
                        <SplideSlide
                            key={category.id}
                            style={{
                                display: "flex",
                                justifyContent: "center",
                                columnGap: 20,
                                alignItems: "center",
                            }}
                        >
                            <Category
                                category={category}
                            ></Category>
                        </SplideSlide>
                    ))}
                </Splide>
                <a href="/services">
                    <button type="submit" className={style.buttonmobile}>
                        Смотреть все
                        <div className={style.vector}>
                            <Vectorright/>
                        </div>
                    </button>
                </a>
            </section>
        </>
    );
}
