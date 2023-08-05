import AppLayout from "../layouts/app.jsx";

function CookiePolicy(props) {
    return (
        <AppLayout properties={props.properties} categories={props.categories}>
            <h1 style={{textAlign: 'center', margin: '300px 0'}}>Политика использования Cookies</h1>
        </AppLayout>
    );
}

export default CookiePolicy;
