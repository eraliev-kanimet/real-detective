import style from "./article.module.scss";

export default function Article({article}) {
    return (
        <a href={'/articles/' + article.slug} className={`${style.post}`}>
            <img style={{maxWidth: '400px', maxHeight: '300px'}} src={article.image} alt="post"></img>
            {article.tags.map((tag, index) => (
                <span key={index}>{tag}</span>
            ))}
            <div className={`${style.post_content}`}>
                <p className={`${style.post_title}`}>{article.name}</p>
                <p className={`${style.post_text}`}>{article.description}</p>
                <div className={`${style.post_bottom}`}>
                    <p className={`${style.post_button}`}>Читать</p>
                    <p className={`${style.post_date}`}>{article.updated_at}</p>
                </div>
            </div>
        </a>
    );
}
