package com.kelompok1.mydoc.ui.booking_order.payment_method;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class PaymentMethodPresenter extends BasePresenter<PaymentMethodView> {
    protected PaymentMethodPresenter(PaymentMethodView view) {
        super(view);
    }

    void getPaymentMethod()
    {
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().getPaymentMethod().enqueue(new Callback<BaseApiResponse<List<PaymentMethodResponse>, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<List<PaymentMethodResponse>, Nullable>> call, Response<BaseApiResponse<List<PaymentMethodResponse>, Nullable>> response) {
                if(response.isSuccessful()){
                    view.loadPaymentGateway(response.body().getData());
                } else {

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<List<PaymentMethodResponse>, Nullable>> call, Throwable t) {
                view.onError(t.getMessage());
            }
        });
    }
}
