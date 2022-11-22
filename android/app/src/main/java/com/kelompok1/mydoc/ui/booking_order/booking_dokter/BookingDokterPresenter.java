package com.kelompok1.mydoc.ui.booking_order.booking_dokter;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.data.remote.request.CheckoutRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class BookingDokterPresenter extends BasePresenter<BookingDokterView> {
    protected BookingDokterPresenter(BookingDokterView view) {
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

    void checkout(int dokter_id, String time, String payment_method)
    {
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().checkout(new CheckoutRequest(dokter_id, time, payment_method)).enqueue(new Callback<BaseApiResponse<Integer, CheckoutRequest>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<Integer, CheckoutRequest>> call, Response<BaseApiResponse<Integer, CheckoutRequest>> response) {
                if(response.isSuccessful()){
                    view.successCheckout(response.body().getMessage(), response.body().getData());
                } else {

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<Integer, CheckoutRequest>> call, Throwable t) {
                view.onError(t.getMessage());
            }
        });
    }
}
