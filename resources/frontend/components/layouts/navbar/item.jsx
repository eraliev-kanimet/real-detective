import React from 'react';
import style from "./navbar.module.scss";
import {ReactComponent as Vectorright} from "../../../assets/images/bxs_chevron-right.svg";

const Item = ({url, name, classes}) => {
    return (
        <a href={url}>
            <li
                className={classes ? classes : style.li}
            >
                {name + " "}
                <div className={style.right}>
                    <Vectorright/>
                </div>
            </li>
        </a>
    );
};

export default Item;
