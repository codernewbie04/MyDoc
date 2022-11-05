package com.kelompok1.mydoc.ui.main.list_dokter;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ListDokterPresenter extends BasePresenter<ListDokterView> {
    protected ListDokterPresenter(ListDokterView view) {
        super(view);
    }

    public void getListDokter()
    {
        ((MvpApp) view.getContext().getApplicationContext()).getMasterService().getListDokter().enqueue(new Callback<BaseApiResponse<List<DetailDokterResponse>, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<List<DetailDokterResponse>, Nullable>> call, Response<BaseApiResponse<List<DetailDokterResponse>, Nullable>> response) {
                if (response.isSuccessful()){
                    view.dokterLoaded(response.body().getData());
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<List<DetailDokterResponse>, Nullable>> call, Throwable t) {

            }
        });
    }
}
