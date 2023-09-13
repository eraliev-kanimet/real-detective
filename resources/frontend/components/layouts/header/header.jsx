import React, {useRef, useLayoutEffect} from "react";

function Header() {
    const headerRef = useRef();

    useLayoutEffect(() => {
        const handleScroll = () => {
            const headerElement = headerRef.current;
            const isSticky = window.scrollY > headerElement.offsetTop;

            if (isSticky) {
                headerElement.classList.add("sticky");
            } else {
                headerElement.classList.remove("sticky");
            }
        };

        window.addEventListener("scroll", handleScroll);

        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, []);

    return (
        <>

        </>
    );
}

export default Header;
