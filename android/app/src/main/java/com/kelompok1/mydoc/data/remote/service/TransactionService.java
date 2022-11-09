package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.data.remote.request.CheckoutRequest;


import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;

public interface TransactionService {
    @GET("v1/transaction/invoice")
    Call<BaseApiResponse<List<HistoryResponse>, Nullable>> getListDokter();

    @GET("v1/transaction/payments")
    Call<BaseApiResponse<List<PaymentMethodResponse>, Nullable>> getPaymentMethod();

    @POST("v1/transaction/checkout")
    Call<BaseApiResponse<Integer, CheckoutRequest>> checkout(@Body CheckoutRequest checkout);
}
