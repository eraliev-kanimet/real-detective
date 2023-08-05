import style from "./review-card.module.scss";
import star from "../../assets/images/icon_star.svg";
import emptyStar from "../../assets/images/icon_empty_star.svg";

export default function Review({review, isLink}) {
    const stars = [];

    const rand = function () {
        return Math.random();
    };

    for (let i = 0; i < review.rating; i++) {
        stars.push(<img src={star} alt="" key={rand()}></img>);
    }

    if (stars.length < 5) {
        const emptyStars = 5 - stars.length;
        for (let i = 0; i < emptyStars; i++) {
            stars.push(<img src={emptyStar} alt="" key={rand()}></img>);
        }
    }

    if (isLink === true) {
        return (
            <>

                <div className={`${style.review}`}>
                    <div className={`${style.review_stars}`}>
                        <span>{review.rating}</span>
                        {stars}
                    </div>
                    <a href="/reviews">
                        <p className={`${style.review_name}`}>{review.name}</p>
                    </a>
                    <p className={`${style.review_date}`}>{review.updated_at}</p>
                    <p className={`${style.review_text}`}>{review.content}</p>
                </div>

            </>
        );
    } else {
        return (

            <div className={`${style.review}`}>
                <div className={`${style.review_stars}`}>
                    <span>{props.review}</span>
                    {stars}
                </div>
                <a
                    target="_blank"
                    href="https://yandex.ru/web-maps/org/77630423623/reviews?reviews[publicId]=fnuuk197am45jz6ep2m0bg0jur&utm_source=review"
                    rel="noreferrer"
                >
                    <p className={`${style.review_name}`}>{props.name}</p>
                </a>
                <p className={`${style.review_date}`}>{props.date}</p>
                <p className={`${style.review_text}`}>{props.text}</p>
            </div>

        );
    }
}
