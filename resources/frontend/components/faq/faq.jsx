import React, {useState, useRef, useEffect} from "react";
import {FiPlus} from "react-icons/fi";
import FormPhoto from "../../assets/images/form-foto.png";
import "./faq.scss";
import SecondModal from "../modal/second.jsx";
import parse from "html-react-parser";

export default function FAQ({content, faq}) {
    return (
        <>
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
        </>
    );
}

const FaqItem = ({content}) => {
    const [active, setActive] = useState(false);
    const contentRef = useRef(null);

    useEffect(() => {
        contentRef.current.style.maxHeight = active
            ? `${contentRef.current.scrollHeight}px`
            : "0px";
    }, [contentRef, active]);

    const toggleAccordion = () => {
        setActive(!active);
    };

    return (
        <button
            className={`question-section ${active}`}
            onClick={toggleAccordion}
        >
            <div style={{width: '100%'}}>
                <div className="question-align">
                    <p className="question-style">{content.question}</p>
                    <FiPlus className={active ? `question-icon rotate` : `question-icon`}/>
                </div>
                <div
                    ref={contentRef}
                    className={active ? `answer answer-divider` : `answer`}
                >
                    {parse(content.answer)}
                </div>
            </div>
        </button>
    );
};
