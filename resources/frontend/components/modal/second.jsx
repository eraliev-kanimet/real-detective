import React, {useState} from 'react';
import HowToReachUs from "../form/how-to-reach-us/how-to-reach-us.jsx"
import Thanks from '../home/thanks-for-contacting-us/thanks-for-contacting-us.jsx';
import Form from '../form/form.jsx';
import MainMobilePopup from '../popup/main-mobile/main-mobile.jsx';

const SecondModal = (props) => {
    const [showFirstModal, setShowFirstModal] = useState(true);
    const [showSecondModal, setShowSecondModal] = useState(false);

    const handleFirstModalButtonClick = () => {
        setShowFirstModal(false);
        setShowSecondModal(true);
    };

    return (
        <>
            {showFirstModal && (
                props.HowToReachUs ? <HowToReachUs properties={props.properties} onButtonClickShow={handleFirstModalButtonClick}/>
                    : props.isMainMobile ? <MainMobilePopup onButtonClickShow={handleFirstModalButtonClick}/> :
                        <Form onButtonClickShow={handleFirstModalButtonClick} isOnMain={props.isOnMain}/>
            )}
            {showSecondModal && (
                props.HowToReachUs || props.isMainMobile ? <Thanks bg={"#110F0F"}/>
                    : <Thanks width={"95%"} height={"260px"}/>)}
        </>
    );
};

export default SecondModal;
