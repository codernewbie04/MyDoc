package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class PaymentResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("invoice_id")
    @Expose
    public int invoice_id;

    @SerializedName("reference")
    @Expose
    public String reference;

    @SerializedName("url")
    @Expose
    public String url;

    @SerializedName("qr_code")
    @Expose
    public String qr_code;

    @SerializedName("vaNumber")
    @Expose
    public String vaNumber;

    @SerializedName("payment_method")
    @Expose
    public String payment_method;

    @SerializedName("payment_name")
    @Expose
    public String payment_name;

    @SerializedName("amount")
    @Expose
    public int amount;

    @SerializedName("status")
    @Expose
    public int status;

    @SerializedName("created_at")
    @Expose
    public String created_at;

}
