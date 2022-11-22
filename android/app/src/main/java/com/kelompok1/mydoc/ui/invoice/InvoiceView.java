package com.kelompok1.mydoc.ui.invoice;

import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface InvoiceView extends BaseView {
    void loadInvoice(InvoiceResponse data);
}
