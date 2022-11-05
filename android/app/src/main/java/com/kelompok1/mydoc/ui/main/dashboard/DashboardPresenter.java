package com.kelompok1.mydoc.ui.main.dashboard;

import android.content.Context;
import android.util.Log;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DashboardResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DashboardPresenter extends BasePresenter<DashboardView> {
    Context mContext;
    public DashboardPresenter(DashboardView view, Context context) {
        super(view);
        this.mContext = context;
    }

    public void getDasbhoard(){
        ((MvpApp) view.getContext().getApplicationContext()).getMasterService().getDashboard().enqueue(new Callback<BaseApiResponse<DashboardResponse, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<DashboardResponse, Nullable>> call, Response<BaseApiResponse<DashboardResponse, Nullable>> response) {
                if(response.isSuccessful()){
                    DashboardResponse data = response.body().getData();
                    view.setUser(data.user);
                    view.setHistory(data.history);
                    view.setMyReview(data.my_review);
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<DashboardResponse, Nullable>> call, Throwable t) {
                Log.d("Test_1", t.getMessage());
            }
        });
    }
}
