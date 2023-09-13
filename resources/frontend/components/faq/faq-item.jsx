import React, {useEffect, useRef, useState} from 'react';
// import {FiPlus} from "react-icons/fi";
import parse from "html-react-parser";

const FaqItem = ({content}) => {
    const [active, setActive] = useState(false);
    const contentRef = useRef(null);

    useEffect(() => {
        contentRef.current.style.maxHeight = active
            ? `${contentRef.current.scrollHeight}px`
            : '0px';
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
                    {/*<FiPlus className={active ? `question-icon rotate` : `question-icon`}/>*/}
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

export default FaqItem;
