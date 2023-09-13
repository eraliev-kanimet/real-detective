import React from "react";
import style from "./pagination.module.scss";
import ArrowLeft from "../../../images/white_arrow_left.svg";
import ArrowRight from "../../../images/white_arrow_right.svg";
import ArrowDown from "../../../images/biege_arrow_down.svg";

const Pagination = ({limit, initLimit, path, links, current, next, prev, last}) => {
    const PaginateHandle = (url) => {
        window.location.href = url
    }

    return (<div className={style.pagination_wrapper}>
        <button
            onClick={() => PaginateHandle(path + '?limit=' + (12 + initLimit))}
            className={limit > initLimit ? style.button_show_more_disabled : style.button_show_more}
        >
            Показать еще 12
            <img src={ArrowDown} alt=""></img>
        </button>
        <div className={style.numbers}>
            {
                links.map(link => {
                    if (link.label === '&laquo; Назад') {
                        return (
                            <button
                                key={link.label}
                                className={current === 1 ? style.arrow_disabled : style.numbers_arrows}
                                disabled={current === 1}
                                onClick={() => PaginateHandle(prev)}
                            >
                                <img src={ArrowLeft} alt=""/>
                            </button>
                        )
                    }

                    if (link.label === 'Вперёд &raquo;') {
                        return (
                            <button
                                key={link.label}
                                className={current === last ? style.arrow_disabled : style.numbers_arrows}
                                disabled={current === last}
                                onClick={() => PaginateHandle(next)}
                            >
                                <img src={ArrowRight} alt=""/>
                            </button>
                        )
                    }

                    return (
                        <span
                            key={link.label}
                            onClick={() => PaginateHandle(link.url)}
                            className={current === Number(link.label) ? style.selected_page_number : ''}
                        >
                            {link.label}
                        </span>
                    )
                })
            }
        </div>
    </div>);
};

export default Pagination;
