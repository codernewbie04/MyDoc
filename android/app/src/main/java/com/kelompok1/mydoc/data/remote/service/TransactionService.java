package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.data.remote.request.CheckoutRequest;
import com.kelompok1.mydoc.data.remote.request.RatingRequest;


import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Path;

public interface TransactionService {
    @GET("v1/transaction/invoice")
    Call<BaseApiResponse<List<InvoiceResponse>, Nullable>> getInvoice();

    @GET("v1/transaction/invoice/{id}")
    Call<BaseApiResponse<InvoiceResponse, Nullable>> getDetailInvoice(@Path("id") int id);

    @GET("v1/transaction/payments")
    Call<BaseApiResponse<List<PaymentMethodResponse>, Nullable>> getPaymentMethod();

    @POST("v1/transaction/checkout")
    Call<BaseApiResponse<Integer, CheckoutRequest>> checkout(@Body CheckoutRequest checkout);

    @POST("v1/transaction/give_rating")
    Call<BaseApiResponse<Nullable, RatingRequest>> giveRating(@Body RatingRequest ratingRequest);
}
