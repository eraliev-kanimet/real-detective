import style from "./blog.module.scss";
import Article from "../../article/article.jsx";
import { Splide, SplideSlide } from "@splidejs/react-splide";
import "@splidejs/react-splide/css";

export default function Blog({articles}) {
  return (
    <>
      <section className={`${style.container}`}>
        <div className={style.header_blog}>
          <h3>Блог</h3>
          <a href="/articles">
            Смотреть все
            <img
              src={"/images/biege_arrow_right.svg"}
              alt="Нажмите, чтобы перейти и посмотреть все посты"
            />
          </a>
        </div>
        <Splide
          options={{
            perPage: 4,
            perMove: 1,
            breakpoints: {
              1280: {
                perPage: 3,
              },
              744: {
                perPage: 2,
              },
              480: {
                perPage: 1,
                height: 570,
                gap: 16,
              },
            },
            rewind: false,
            autoWidth: true,
            height: 630,
            pagination: false,
            arrows: false,
            type: "loop",
            gap: 24,
          }}
          className={style.custom_splide}
          aria-label="Blog Posts"
        >
          {articles.map((article) => (
            <SplideSlide
              key={article.id}
              style={{
                display: "flex",
                justifyContent: "center",
                columnGap: 20,
                alignItems: "center",
              }}
            >
              <Article slide={true} article={article}></Article>
            </SplideSlide>
          ))}
        </Splide>
      </section>
    </>
  );
}
