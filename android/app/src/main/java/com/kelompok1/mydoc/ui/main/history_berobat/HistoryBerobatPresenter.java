package com.kelompok1.mydoc.ui.main.history_berobat;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
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
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().getInvoice().enqueue(new Callback<BaseApiResponse<List<InvoiceResponse>, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<List<InvoiceResponse>, Nullable>> call, Response<BaseApiResponse<List<InvoiceResponse>, Nullable>> response) {
                if(response.isSuccessful()){
                    view.loadHistoryBerobat(response.body().getData());
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<List<InvoiceResponse>, Nullable>> call, Throwable t) {
            }
        });
    }
}
