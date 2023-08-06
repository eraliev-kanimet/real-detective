import style from "./breadcrumbs.module.scss";

const Breadcrumbs = ({links}) => {
    return (
        <nav aria-label="breadcrumb" className={style.breadcrumbs}>
            <ol>
                <li>
                    <a href="/">Главная</a>
                </li>
                {
                    links.map((link, index) => link.last ? (
                        <li key={index}>
                            <span key={index} className={style.separator}>/</span>
                            <span>{link.name}</span>
                        </li>
                    ) : (
                        <li key={index}>
                            <span key={index} className={style.separator}>/</span>
                            <a href={link.url}>{link.name}</a>
                        </li>
                    ))
                }
            </ol>
        </nav>
    );
};

export default Breadcrumbs;
