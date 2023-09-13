import React from "react";
import FormPhoto from "../../../images/form-foto.png";
import "./faq.scss";
import SecondModal from "../modal/second.jsx";
import FaqItem from "./faq-item.jsx";

export default function FAQ({content, faq}) {
    return (
        <section className="container">
            <h3 className="h3">ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ</h3>
            <div className="blok">
                <div className="question-blok">
                    {faq.map((item, index) => (
                        <FaqItem content={item} key={index}/>
                    ))}
                </div>
                <div className="blokform">
                    <p className="title">Связаться с частным детективом</p>
                    <div className="blokdirector">
                        <img src={FormPhoto} alt="director" className="photo"/>
                        <p className="text">
                            {content.post}
                            <br/>
                            <span className="textdirector">{content.name}</span>
                        </p>
                    </div>
                    <SecondModal></SecondModal>
                </div>
            </div>
        </section>
    );
}
