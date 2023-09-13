import React from 'react';
import style from "../../assets/pages/catalog/index.module.scss";
import {ReactComponent as Person} from "../../../images/dashicons_businessman.svg";
import {ReactComponent as Business} from "../../../images/dashbusiness-center.svg";

const CategoryTab = ({current, category, categoryName, onClick}) => {
    return (
        <div
            onClick={onClick}
            className={
                current === category ? [
                    style.tabs__category, style.active
                ].join(' ') : style.tabs__category
            }>
            {category === 'private_person' ? (
                <Person alt="person" className={style.icon}/>
            ) : (
                <Business alt="small suitcase" className={style.icon}/>
            )}
            {categoryName}
        </div>
    );
};

export default CategoryTab;
