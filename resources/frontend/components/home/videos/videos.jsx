import style from "./videos.module.scss";
import {Splide, SplideSlide} from "@splidejs/react-splide";
import "@splidejs/react-splide/css";
import icon from "../../../../images/icon_youtube.svg";
import play from "../../../../images/play_button.svg";
import {useEffect, useState} from "react";

export default function Videos(props) {
    const [videos, setVideos] = useState([])

    useEffect(() => {
        setVideos(props.videos)
    }, [props])

    return (
        <section className={`${style.container}`}>
            <div className={`${style.youtube_header}`}>
                <h3 className={style.h3}>ПОЗНАКОМЬТЕСЬ С P&P НА YOUTUBE</h3>
                <a
                    className={style.a}
                    href={props.properties.youtube}
                    target="_blank"
                    rel="noreferrer"
                >
          <span>
            Наш блог на YouTube
            <img src={icon} alt="YouTube"/>
          </span>
                </a>
            </div>
            <Splide
                options={{
                    perPage: 2,
                    breakpoints: {
                        1280: {
                            perPage: 3,
                        },
                        968: {
                            perPage: 2,
                            arrows: false,
                        },
                        500: {
                            perPage: 2,
                            height: 200,
                            gap: 0,
                            arrows: false,
                        },
                    },
                    perMove: 1,
                    rewind: true,
                    autoWidth: true,
                    height: 487,
                    pagination: false,
                    arrows: true,
                    type: "loop",
                    gap: 10,
                }}
                className={`${style.custom_splide}`}
            >
                {videos.map((video, index) => (
                    <SplideSlide key={index}>
                        <a
                            href={video.link}
                            target="_blank"
                            rel="noreferrer"
                        >
                            <img
                                className={style.video}
                                src={video.preview}
                                alt="video"
                            />
                            <img
                                className={style.play}
                                src={play}
                                alt="play video"
                            />
                        </a>
                    </SplideSlide>
                ))}
            </Splide>
        </section>
    );
}
