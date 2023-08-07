import React from "react";
import style from "./categories.module.scss";
import {Scrollbar} from "react-scrollbars-custom";
import Subcategories from "./subcategories.jsx";

export default function Categories({categories}) {
    return (
        <div className={style.catalog}>
            <div>
                <div className={style.catalog_inner}>
                    <Scrollbar
                        style={{
                            width: "93vw",
                            height: "33vw",
                        }}
                    >
                        <div className={style.catalog_inner2}>
                            {categories.map(category => (
                                <Subcategories key={category.id} category={category}/>
                            ))}
                        </div>
                    </Scrollbar>
                </div>
            </div>
        </div>
    );
}
