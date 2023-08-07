import AppLayout from "../layouts/app.jsx";
import style from "../assets/pages/reviews.module.scss";
import Pagination from "../components/pagination/pagination.jsx";
import Breadcrumbs from "../components/breadcrumbs/breadcrumbs.jsx";
import {useEffect, useState} from "react";
import Review from "../components/review-card/review-card.jsx";

function Reviews(props) {
    const [reviews, setReviews] = useState([])

    useEffect(() => {
        if (props.reviews.data.length) {
            setReviews(props.reviews.data)
        }
    }, [props]);

    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div className={style.page_container}>
                <section className={style.page_header}>
                    <Breadcrumbs links={[{last: true, name: 'Отзывы'}]}/>
                    <h3 className={style.page_title}>
                        отзывы о компании pershin & partners
                    </h3>
                    <a
                        href={props.properties.reviews}
                        target="_blank"
                        rel="noreferrer"
                        className={style.page_link}
                    >
                        Оставить отзыв
                        <img src={"/images/biege_arrow_right.svg"} alt="отзыв"></img>
                    </a>
                </section>
                <div className={style.page_block}>
                    {reviews.map(review => <Review key={review.id} review={review}/>)}
                </div>
                <Pagination
                    path={props.reviews.path}
                    limit={props.reviews.per_page}
                    initLimit={12}
                    current={props.reviews.current_page}
                    last={props.reviews.last_page}
                    next={props.reviews.next_page_url}
                    prev={props.reviews.prev_page_url}
                    links={props.reviews.links}
                />
            </div>
        </AppLayout>
    );
}

export default Reviews;
