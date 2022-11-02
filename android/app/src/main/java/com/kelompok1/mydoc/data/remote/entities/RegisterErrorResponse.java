package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class RegisterErrorResponse {
    @SerializedName("fullname")
    @Expose
    public String fullname = null;

    @SerializedName("email")
    @Expose
    public String email  = null;

    @SerializedName("birthdate")
    @Expose
    public String birthdate = null;

    @SerializedName("address")
    @Expose
    public String address = null;

    @SerializedName("password1")
    @Expose
    public String password1 = null;

    @SerializedName("password2")
    @Expose
    public String password2 = null;
}
