import React, { useState } from "react";
import "./social-media.scss";
import { ReactComponent as MediaButttons } from "../../../assets/images/bxs_chat.svg";
import Telegram from "../../../assets/images/telegram.svg";
import WhatsApp from "../../../assets/images/whatsapp.svg";
import {LazyLoadImage} from "react-lazy-load-image-component";

const SocialMediaButtons = ({properties}) => {
    const [showButtons, setShowButtons] = useState(false);

    const handleButtonClick = () => {
        setShowButtons(!showButtons);
    };

    return (
        <div className="socmedia_container">
            <button onClick={handleButtonClick} className="socmedia_button">
                <MediaButttons
                    alt="socmedia"
                    className={`socmedia_icon ${showButtons ? "clicked" : ""}`}
                    style={{
                        transition: "transform 0.3s ease",
                    }}
                />
            </button>
            <div className={`social-buttons ${showButtons ? "show" : "hide"}`}>
                <a
                    href={'https://t.me/' + properties.telegram}
                    target="_blank"
                    rel="noreferrer"
                >
                    <LazyLoadImage src={Telegram} alt="Telegram" className="socmedia_telegram" />
                </a>
                <a
                    href={properties.whatsapp}
                    target="_blank"
                    rel="noreferrer"
                >
                    <LazyLoadImage src={WhatsApp} alt="WhatsApp" className="socmedia_whatsapp" />
                </a>
            </div>
        </div>
    );
};

export default SocialMediaButtons;
