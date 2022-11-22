package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class CheckoutRequest {
    public CheckoutRequest(){}

    public CheckoutRequest(int dokter_id, String time, String payment_method) {
        this.dokter_id = dokter_id;
        this.time = time;
        this.payment_method = payment_method;
    }

    @SerializedName("dokter_id")
    @Expose
    private int dokter_id;

    @SerializedName("time")
    @Expose
    private String time;

    @SerializedName("payment_method")
    @Expose
    private String payment_method;
}
