import Header from "../components/layouts/header/header.jsx";
import Footer from "../components/layouts/footer/footer.jsx";
import {useEffect} from "react";

function AppLayout({children, properties, categories}) {

    useEffect(() => {
        window.scrollTo(0, 0);
    }, [])

    return (
        <>
            <Header properties={properties} categories={categories}/>
            <main>
                {children}
            </main>
            <Footer properties={properties} categories={categories}/>
        </>
    );
}

export default AppLayout;
