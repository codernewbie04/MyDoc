package com.kelompok1.mydoc.ui.booking_order.payment_method;

import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;

public interface OnPaymentMethodClick {
    void onClick (PaymentMethodResponse paymentCode);
}
