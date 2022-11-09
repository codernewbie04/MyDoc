package com.kelompok1.mydoc.ui.booking_order.payment_method;

import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

import java.util.List;

public interface PaymentMethodView extends BaseView {
    void loadPaymentGateway(List<PaymentMethodResponse> data);
}
