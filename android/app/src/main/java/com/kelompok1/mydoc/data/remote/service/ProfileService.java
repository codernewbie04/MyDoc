package com.kelompok1.mydoc.data.remote.service;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.data.remote.request.EditPasswordRequest;
import com.kelompok1.mydoc.data.remote.request.EditProfileRequest;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.PUT;

public interface ProfileService {

    @GET("v1/profile/pasien")
    Call<BaseApiResponse<UserResponse, Nullable>> getUser();

    @PUT("v1/profile/pasien")
    Call<BaseApiResponse<UserResponse, EditProfileRequest>> editProfile(@Body EditProfileRequest edit);

    @PUT("v1/profile/pasien/password")
    Call<BaseApiResponse<Nullable, EditPasswordRequest>> editPassword(@Body EditPasswordRequest edit);
}
