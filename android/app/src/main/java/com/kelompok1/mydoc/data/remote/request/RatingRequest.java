package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class RatingRequest {
    @SerializedName("invoice_id")
    @Expose
    private int invoice_id;

    @SerializedName("description")
    @Expose
    private String description;

    @SerializedName("star")
    @Expose
    private int star;

    public RatingRequest(){}

    public RatingRequest(int invoice_id, int star, String description) {
        this.invoice_id = invoice_id;
        this.description = description;
        this.star = star;
    }
}
