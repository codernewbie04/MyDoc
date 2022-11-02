package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.RegisterErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.RegisterResponse;
import com.kelompok1.mydoc.data.remote.request.LoginRequest;
import com.kelompok1.mydoc.data.remote.request.RegisterRequest;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface AuthService {
    @POST("v1/auth/login")
    Call<BaseApiResponse<LoginResponse, LoginErrorResponse>> login(@Body LoginRequest loginRequest);

    @POST("v1/auth/register")
    Call<BaseApiResponse<RegisterResponse, RegisterErrorResponse>> register(@Body RegisterRequest registerRequest);

    @POST("v1/auth/refresh")
    Call<BaseApiResponse<String, Nullable>> refreshToken();

}
