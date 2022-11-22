package com.kelompok1.mydoc.ui.booking_order.detail;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DetailDokterPresenter extends BasePresenter<DetailDokterView> {
    protected DetailDokterPresenter(DetailDokterView view) {
        super(view);
    }

    void getDokter(int id)
    {
        ((MvpApp) view.getContext().getApplicationContext()).getMasterService().getDetailDokter(id).enqueue(new Callback<BaseApiResponse<DetailDokterResponse, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<DetailDokterResponse, Nullable>> call, Response<BaseApiResponse<DetailDokterResponse, Nullable>> response) {
                if(response.isSuccessful()){
                    view.loadDetailDokter(response.body().getData());
                } else {

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<DetailDokterResponse, Nullable>> call, Throwable t) {
                view.onError(t.getMessage());
            }
        });
    }


}
