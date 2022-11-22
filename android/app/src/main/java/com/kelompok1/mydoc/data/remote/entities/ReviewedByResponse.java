package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class ReviewedByResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("fullname")
    @Expose
    public String fullname;

    @SerializedName("image")
    @Expose
    public String image;


    @SerializedName("created_at")
    @Expose
    public String created_at;


}
