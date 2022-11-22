package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class RegisterRequest {
    @SerializedName("fullname")
    @Expose
    private String fullname;

    @SerializedName("email")
    @Expose
    private String email;

    @SerializedName("birthdate")
    @Expose
    private String birthdate;

    @SerializedName("address")
    @Expose
    private String address;

    @SerializedName("password1")
    @Expose
    private String password1;

    @SerializedName("password2")
    @Expose
    private String password2;

    public RegisterRequest(String fullname, String email, String birthdate, String address, String password1, String password2) {
        this.fullname = fullname;
        this.email = email;
        this.birthdate = birthdate;
        this.address = address;
        this.password1 = password1;
        this.password2 = password2;
    }
}
