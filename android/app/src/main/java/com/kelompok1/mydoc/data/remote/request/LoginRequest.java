package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class LoginRequest {
    @SerializedName("email")
    @Expose
    private String email;

    @SerializedName("password")
    @Expose
    private String password;

    @SerializedName("fcm_token")
    @Expose
    private String fcm_token;

    public LoginRequest(String email, String password, String fcm_token) {
        this.email = email;
        this.password = password;
        this.fcm_token = fcm_token;
    }

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
