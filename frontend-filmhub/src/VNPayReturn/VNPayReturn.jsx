import React from "react";
import classNames from "classnames";

import styles from "./index.module.css";
import { useSearchParams } from "react-router-dom";

const VNPayReturn = () => {
  const [searchParams] = useSearchParams();

  const vnpResponseCode = searchParams.get("vnp_ResponseCode");

  return (
    <div className={classNames("container", styles.wrapper)}>
      {vnpResponseCode === "00" ? (
        <>
          <img
            src="/images/payment-success.webp"
            alt="Payment success"
            className={styles.image}
          />
          <h2 className={styles.title}>Thanh toán thành công</h2>
        </>
      ) : (
        <>
          <img
            src="/images/payment-failed.png"
            alt="Payment failed"
            className={styles.image}
          />
          <h2 className={styles.title}>Thanh toán thất bại</h2>
        </>
      )}
    </div>
  );
};

export default VNPayReturn;
