package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.DashboardResponse;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.data.remote.entities.ResponseKosong;


import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;

public interface MasterService {
    @GET("v1/master/dashboard")
    Call<BaseApiResponse<DashboardResponse, Nullable>> getDashboard();

    @GET("v1/master/dokter")
    Call<BaseApiResponse<List<DetailDokterResponse>, Nullable>> getListDokter();
}
