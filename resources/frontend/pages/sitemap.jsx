import AppLayout from "../layouts/app.jsx";
import "../assets/pages/sitemap.css"

function Sitemap(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div className='sitemap'>
                <h1>Карта сайта</h1>
                <div className='sitemap_content'>
                    <ul className='sitemap_ul'>
                        <li>
                            <h3>Страницы</h3>
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><a href="/faq">FAQ</a></li>
                                <li><a href="/reviews">Отзывы</a></li>
                                <li><a href="/contacts">Контакты</a></li>
                                <li><a href="/cookies-policy">Cookies Policy</a></li>
                                <li><a href="/privacy-policy">Privacy Policy</a></li>
                                <li><a href="/blog">Блог</a></li>
                                <li><a href="/services">Услуги</a></li>
                                <li><a href="/price">Цены</a></li>
                            </ul>
                        </li>
                        <li>
                            <h3>Услуги</h3>
                            <ul>
                                {props.services.map((service, index) => (
                                    <li key={index}><a href={'/services/' + service.slug}>{service.name}</a></li>
                                ))}
                            </ul>
                        </li>
                        <li>
                            <h3>Статьи</h3>
                            <ul>
                                {props.articles.map((article, index) => (
                                    <li key={index}><a href={'/blog/' + article.slug}>{article.name}</a></li>
                                ))}
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </AppLayout>
    );
}

export default Sitemap;
