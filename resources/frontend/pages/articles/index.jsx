import style from "../../assets/pages/articles/index.module.scss";
import Pagination from "../../components/pagination/pagination.jsx";
import AppLayout from "../../layouts/app.jsx";
import Breadcrumbs from "../../components/breadcrumbs/breadcrumbs.jsx";
import {useEffect, useState} from "react";
import Article from "../../components/article/article.jsx";

function ArticlesIndex(props) {
    const [articles, setArticles] = useState([])

    useEffect(() => {
        if (props.articles.data.length) {
            setArticles(props.articles.data)
        }
    }, [props]);

    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div className={style.page_container}>
                <section className={style.page_header}>
                    <Breadcrumbs links={[{last: true, name: 'Блог'}]}/>
                    <h3 className={style.page_title}>Блог</h3>
                </section>
                <div className={style.block_container}>
                    {articles.map(article => <Article key={article.id} article={article}/>)}
                </div>
                <Pagination
                    path={props.articles.meta.path}
                    limit={props.articles.meta.per_page}
                    initLimit={12}
                    current={props.articles.meta.current_page}
                    last={props.articles.meta.last_page}
                    next={props.articles.links.next}
                    prev={props.articles.links.prev}
                    links={props.articles.meta.links}
                />
            </div>
        </AppLayout>
    );
}

export default ArticlesIndex;
