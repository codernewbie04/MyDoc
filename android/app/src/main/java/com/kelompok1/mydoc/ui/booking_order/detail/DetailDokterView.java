package com.kelompok1.mydoc.ui.booking_order.detail;

import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface DetailDokterView extends BaseView {
    void loadDetailDokter(DetailDokterResponse dokter);
}
