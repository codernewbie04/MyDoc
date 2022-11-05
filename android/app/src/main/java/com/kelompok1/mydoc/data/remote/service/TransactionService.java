package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;


import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

public interface TransactionService {
    @GET("v1/transaction/invoice")
    Call<BaseApiResponse<List<HistoryResponse>, Nullable>> getListDokter();
}
