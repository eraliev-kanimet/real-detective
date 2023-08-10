import AppLayout from "../layouts/app.jsx";
import parse from "html-react-parser";
import '../assets/pages/cookie.scss'

function CookiePolicy(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <div className="container">
                {parse(props.content.cookies_policy)}
            </div>
        </AppLayout>
    );
}

export default CookiePolicy;
