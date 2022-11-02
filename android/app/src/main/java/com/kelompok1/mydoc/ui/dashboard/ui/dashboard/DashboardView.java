package com.kelompok1.mydoc.ui.dashboard.ui.dashboard;

import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

import java.util.List;

public interface DashboardView extends BaseView {
    void setUser(UserResponse user);
    void setHistory(List<HistoryResponse> history);
    void setMyReview(List<MyReviewResponse> my_review);
}
