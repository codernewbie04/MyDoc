package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class RatingsResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("star")
    @Expose
    public int star;

    @SerializedName("description")
    @Expose
    public String description;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("reviewed_by")
    @Expose
    public ReviewedByResponse reviewed_by;



}
