package com.kelompok1.mydoc.ui.invoice;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class InvoicePresenter extends BasePresenter<InvoiceView> {
    protected InvoicePresenter(InvoiceView view) {
        super(view);
    }

    void getInvoice(int id)
    {
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().getDetailInvoice(id).enqueue(new Callback<BaseApiResponse<InvoiceResponse, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<InvoiceResponse, Nullable>> call, Response<BaseApiResponse<InvoiceResponse, Nullable>> response) {
                if(response.isSuccessful()){
                    view.loadInvoice(response.body().getData());
                } else {

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<InvoiceResponse, Nullable>> call, Throwable t) {
                view.onError(t.getMessage());
            }
        });
    }
}
