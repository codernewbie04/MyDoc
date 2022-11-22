package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DashboardResponse;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.data.remote.entities.ListDokterResponse;


import java.util.List;

import retrofit2.Call;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.Path;

public interface MasterService {
    @GET("v1/master/dashboard")
    Call<BaseApiResponse<DashboardResponse, Nullable>> getDashboard();

    @GET("v1/master/dokter")
    Call<BaseApiResponse<List<ListDokterResponse>, Nullable>> getListDokter();

    @GET("v1/master/dokter/{id}")
    Call<BaseApiResponse<DetailDokterResponse, Nullable>> getDetailDokter(@Path("id") int id);
}
