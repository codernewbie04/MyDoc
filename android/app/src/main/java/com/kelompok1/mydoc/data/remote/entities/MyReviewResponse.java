package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class MyReviewResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("invoice_id")
    @Expose
    public int invoice_id;

    @SerializedName("reviewed_by")
    @Expose
    public int reviewed_by;

    @SerializedName("star")
    @Expose
    public int star;

    @SerializedName("description")
    @Expose
    public String description;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("dokter")
    @Expose
    public DokterResponse dokter;
}
