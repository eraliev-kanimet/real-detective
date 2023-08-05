import AppLayout from "../layouts/app.jsx";
import FAQ from "../components/faq/faq.jsx";

function Faq(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <FAQ faq={props.content.faq} content={props.content.block3}/>
        </AppLayout>
    );
}

export default Faq;
