package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DetailDokterResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("instansi_id")
    @Expose
    public int instansi_id;

    @SerializedName("nama")
    @Expose
    public String nama;

    @SerializedName("profession")
    @Expose
    public String profession;

    @SerializedName("image")
    @Expose
    public String image;

    @SerializedName("price")
    @Expose
    public int price;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("instansi")
    @Expose
    public String instansi;

    @SerializedName("review")
    @Expose
    public ReviewResponse review;
}
