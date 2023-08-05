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

function Home(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <MainBG properties={props.properties}/>
            <About content={props.content.block1}/>
            <Categories categories={props.categories}/>
            <License/>
            <Videos videos={props.content.videos ?? []} properties={props.properties}/>
            <FirstVisit content={props.content.block2}/>
            <Director properties={props.properties} content={props.content.block3}/>
            <Review reviews={props.reviews} properties={props.properties}/>
            <Safety content={props.content.block4}/>
            <FAQ faq={props.content.faq} content={props.content.block3}/>
            <Blog articles={props.articles}/>
            <Map map={props.properties.map}/>
        </AppLayout>
    );
}

export default Home;
