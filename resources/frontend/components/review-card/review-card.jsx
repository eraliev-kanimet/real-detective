import style from "./review-card.module.scss";
import star from "../../../images/icon_star.svg";
import emptyStar from "../../../images/icon_empty_star.svg";

export default function Review({review}) {
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

    return (
        <div className={`${style.review}`}>
            <div className={`${style.review_stars}`}>
                <span>{review.rating}</span>
                {stars}
            </div>
            <a
                target={review.url ? '_blank' : '_self'}
                href={review.url ? review.url : '/reviews'}
                rel='noreferrer'
            >
                <p className={`${style.review_name}`}>{review.name}</p>
            </a>
            <p className={`${style.review_date}`}>{review.updated_at}</p>
            <p className={`${style.review_text}`}>{review.content}</p>
        </div>
    );
}
