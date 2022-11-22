package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class LoginErrorResponse {
    @SerializedName("email")
    @Expose
    public String email = null;

    @SerializedName("password")
    @Expose
    public String password = null;

    @SerializedName("fcm_token")
    @Expose
    public String fcm_token = null;


    public String getEmail() {
        return email;
    }

    public String getPassword() {
        return password;
    }

    public String getFcm_token() {
        return fcm_token;
    }
}
