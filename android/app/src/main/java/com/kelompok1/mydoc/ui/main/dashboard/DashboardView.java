package com.kelompok1.mydoc.ui.main.dashboard;

import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.data.remote.entities.RatingsResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

import java.util.List;

public interface DashboardView extends BaseView {
    void setUser(UserResponse user);
    void setHistory(List<InvoiceResponse> history);
    void setMyReview(List<RatingsResponse> my_review);
}
