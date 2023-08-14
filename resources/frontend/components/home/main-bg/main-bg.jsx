import React, {useState} from "react";
import Vectorright from "../../../assets/svg/Vectorright.jsx";
import style from "./main-bg.module.scss";
import SecondModal from "../../modal/second.jsx";
import Popup from "../../popup/popup.jsx";
import SocialMediaButtons from "../../button/social-media/social-media.jsx";

function MainBG({properties}) {
    const [buttonPopup, setButtonPopup] = useState(false);

    return (
        <>
            <section className={style.background}>
                <div className={style.container}>
                    <h1 className={style.h1}>perhin & partners</h1>
                    <h2 className={style.h2}>детективное агентство в москве</h2>

                    <SecondModal properties={properties} isOnMain={true}></SecondModal>

                    <SocialMediaButtons properties={properties}/>
                </div>
            </section>
            <div className={style.button_mobile}>
                <button
                    type="submit"
                    className={style.button}
                    onClick={() => setButtonPopup(true)}
                >
                    Оставить заявку
                    <div className={style.vector}>
                        <Vectorright/>
                    </div>
                </button>
                <Popup trigger={buttonPopup} setTrigger={setButtonPopup}>
                    <SecondModal properties={properties} isMainMobile={true}/>
                </Popup>
            </div>
        </>
    );
}

export default MainBG;
