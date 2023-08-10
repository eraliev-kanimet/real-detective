import style from "./article.module.scss";

export default function Article({article, slide}) {
    return (
        <a href={'/blog/' + article.slug} className={`${style.post}`}>
            <img
                className={slide ? style.slide : ''}
                src={article.image}
                alt="post"
            ></img>
            {article.tags.map((tag, index) => (
                <span key={index}>{tag}</span>
            ))}
            <div className={slide ? style.post_content_slide : style.post_content}>
                <p className={`${style.post_title}`}>{article.name}</p>
                <p className={`${style.post_text}`}>{article.description}</p>
                <div className={`${style.post_bottom}`}>
                    <p className={`${style.post_button}`}>Читать</p>
                    <p className={`${style.post_date}`}>{article.date}</p>
                </div>
            </div>
        </a>
    );
}
