import style from "./prices.module.scss";

export default function Prices({items}) {
    return (
        <table className={style.table}>
            <thead className={style.thead}>
            <tr>
                <th className={style.th1}>Название услуги</th>
                <th className={style.th2}>Размер минимального аванса</th>
                <th className={style.th3}>Средний чек</th>
                <th className={style.th4}>Тип контракта</th>
            </tr>
            </thead>
            <tbody>
            {items.map(service => (
                <tr key={service.id}>
                    <td className={style.td1}>{service.name}</td>
                    <td className={style.td2}>От {service.minimum_advance_amount} руб</td>
                    <td className={style.td3}>{service.average_receipt} руб</td>
                    <td className={style.td4}>{service.contract_type}</td>
                </tr>
            ))}
            </tbody>
        </table>
    );
}
