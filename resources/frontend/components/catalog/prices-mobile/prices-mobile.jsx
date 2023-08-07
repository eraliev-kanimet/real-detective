import style from "./prices-mobile.module.scss";

export default function PricesMobile({items}) {
  return (
      <div className={style.blok}>
          {items.map(service => (
              <div key={service.id} className={style.blok_tablemobile}>
                  <p className={style.title}>{service.name}</p>
                  <div className={style.section_price}>
                      <div className={style.blok_price}>
                          <p className={style.text}>Минимальный аванс</p>
                          <p className={style.price}>От {service.minimum_advance_amount} руб</p>
                      </div>
                      <div className={style.blok_price}>
                          <p className={style.text}>Средний чек</p>
                          <p className={style.price}>{service.average_receipt} руб</p>
                      </div>
                      <div className={style.blok_price}>
                          <p className={style.text}>Тип контракта</p>
                          <p className={style.price}>{service.contract_type}</p>
                      </div>
                  </div>
              </div>
          ))}
      </div>
  );
}
