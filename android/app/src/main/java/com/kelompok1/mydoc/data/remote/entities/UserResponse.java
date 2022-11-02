package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class UserResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("email")
    @Expose
    public String email;

    @SerializedName("username")
    @Expose
    public String username;

    @SerializedName("fullname")
    @Expose
    public String fullname;

    @SerializedName("image")
    @Expose
    public String image;

    @SerializedName("status")
    @Expose
    public int status;

    @SerializedName("active")
    @Expose
    public int active;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("updated_at")
    @Expose
    public String updated_at;

    @SerializedName("balance")
    @Expose
    public int balance;

    public UserResponse(){}

    public UserResponse(int id, String email, String fullname, String image, int balance) {
        this.id = id;
        this.email = email;
        this.fullname = fullname;
        this.image = image;
        this.balance = balance;
    }
}
