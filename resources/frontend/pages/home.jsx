import AppLayout from "../layouts/app.jsx";
import MainBG from "../components/home/main-bg/main-bg.jsx";
import About from "../components/home/about/about.jsx";
import Blog from "../components/home/blog/blog.jsx";
import Director from "../components/home/director/director.jsx";
import FAQ from "../components/faq/faq.jsx";
import FirstVisit from "../components/home/first-visit/first-visit.jsx";
import License from "../components/home/license/license.jsx";
import Map from "../components/home/map/map.jsx";
import Review from "../components/home/review/review.jsx";
import Safety from "../components/home/safety/safety.jsx";
import Categories from "../components/home/categories/categories.jsx";
import Videos from "../components/home/videos/videos.jsx";
import {useEffect, useState} from "react";

function Home(props) {
    const [content, setContent] = useState({})
    const [categories, setCategories] = useState({})
    const [properties, setProperties] = useState({})

    useEffect(() => {
        setContent(props.content)
        setCategories(props.categories)
        setProperties(props.properties)
    }, [props])

    return (
        <AppLayout properties={properties} categories={categories}>
            <MainBG properties={properties}/>
            <About content={content.block1}/>
            <Categories categories={categories}/>
            <License/>
            <Videos videos={content.videos ?? []} properties={properties}/>
            <FirstVisit content={content.block2}/>
            <Director properties={properties} content={content.block3}/>
            <Review reviews={props.reviews} properties={properties}/>
            <Safety content={content.block4}/>
            <FAQ faq={content.faq} content={content.block3}/>
            <Blog articles={props.articles}/>
            <Map map={properties.map}/>
        </AppLayout>
    );
}

export default Home;
