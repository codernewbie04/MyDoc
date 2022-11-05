package com.kelompok1.mydoc.ui.main.history_berobat;

import android.util.Log;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HistoryBerobatPresenter extends BasePresenter<HistoryBerobatView> {
    protected HistoryBerobatPresenter(HistoryBerobatView view) {
        super(view);
    }
    void getHistoryBerobat()
    {
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().getListDokter().enqueue(new Callback<BaseApiResponse<List<HistoryResponse>, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<List<HistoryResponse>, Nullable>> call, Response<BaseApiResponse<List<HistoryResponse>, Nullable>> response) {
                if(response.isSuccessful()){
                    view.loadHistoryBerobat(response.body().getData());
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<List<HistoryResponse>, Nullable>> call, Throwable t) {
            }
        });
    }
}
