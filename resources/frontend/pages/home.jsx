import AppLayout from "../layouts/app.jsx";
import MainBG from "../components/home/main-bg/main-bg.jsx";
import About from "../components/home/about/about.jsx";

import {lazy, Suspense} from "react";

const Categories = lazy(() => import('../components/home/categories/categories.jsx'));
const License = lazy(() => import('../components/home/license/license.jsx'));
const Videos = lazy(() => import('../components/home/videos/videos.jsx'));
const FirstVisit = lazy(() => import('../components/home/first-visit/first-visit.jsx'));
const Director = lazy(() => import('../components/home/director/director.jsx'));
const Review = lazy(() => import('../components/home/review/review.jsx'));
const Safety = lazy(() => import('../components/home/safety/safety.jsx'));
const FAQ = lazy(() => import('../components/faq/faq.jsx'));
const Blog = lazy(() => import('../components/home/blog/blog.jsx'));
const Map = lazy(() => import('../components/home/map/map.jsx'));

function Home(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <MainBG properties={props.properties}/>
            <About content={props.content.block1}/>
            <Suspense fallback={() => console.log('Loading')}>
                <Categories categories={props.categories}/>
                <License/>
                <Videos videos={props.content.videos ?? []} properties={props.properties}/>
                <FirstVisit content={props.content.block2}/>
                <Director properties={props.properties} content={props.content.block3}/>
                <Review reviews={props.reviews} properties={props.properties}/>
                <Safety content={props.content.block4}/>
                <FAQ faq={props.content?.faq?.home ?? []} content={props.content.block3}/>
                <Blog header='Блог' articles={props.articles?.data ?? []}/>
                <Map map={props.properties.map}/>
            </Suspense>
        </AppLayout>
    );
}

export default Home;
