import Header from "../components/layouts/header/header.jsx";
import {lazy, Suspense, useEffect} from "react";

const Footer = lazy(() => import('./../components/layouts/footer/footer.jsx'));

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
            <Suspense fallback={() => console.log('Loading')}>
                <Footer properties={properties} categories={categories}/>
            </Suspense>
        </>
    );
}

export default AppLayout;
