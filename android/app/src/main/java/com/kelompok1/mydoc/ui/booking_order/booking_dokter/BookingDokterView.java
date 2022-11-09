package com.kelompok1.mydoc.ui.booking_order.booking_dokter;

import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface BookingDokterView extends BaseView {
    void loadDetailDokter(DetailDokterResponse dokter);
    void successCheckout(String msg, int invoice_id);
}
