package com.kelompok1.mydoc.ui.main.dashboard;

import android.content.Context;
import android.util.Log;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DashboardResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.shashank.sony.fancytoastlib.FancyToast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DashboardPresenter extends BasePresenter<DashboardView> {
    Context mContext;
    public DashboardPresenter(@NonNull DashboardView view, Context context) {
        super(view);
        this.mContext = context;
    }

    public void getDasbhoard(){
        ((MvpApp) view.getContext().getApplicationContext()).getMasterService().getDashboard().enqueue(new Callback<BaseApiResponse<DashboardResponse, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<DashboardResponse, Nullable>> call, Response<BaseApiResponse<DashboardResponse, Nullable>> response) {
                if(response.isSuccessful()){
                    DashboardResponse data = response.body().getData();
                    if(view != null) {
                        view.setUser(data.user);
                        view.setHistory(data.history);
                        view.setMyReview(data.my_review);
                    }
                } else {
                    BaseApiResponse<DashboardResponse, Nullable> errResponse = CommonUtils.parseError(response, new TypeToken<BaseApiResponse<DashboardResponse, Nullable>>() {}.getType());
                    if(view != null)
                        view.onError(errResponse.getMessage());
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<DashboardResponse, Nullable>> call, Throwable t) {
                if(view != null)
                    view.onError(t.getMessage());
            }
        });
    }
}
