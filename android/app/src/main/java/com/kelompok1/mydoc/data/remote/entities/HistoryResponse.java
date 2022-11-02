package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class HistoryResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("no_invoice")
    @Expose
    public String no_invoice;

    @SerializedName("user_id")
    @Expose
    public int user_id;

    @SerializedName("dokter_id")
    @Expose
    public int dokter_id;

    @SerializedName("price")
    @Expose
    public int price;

    @SerializedName("discount")
    @Expose
    public int discount;

    @SerializedName("total_price")
    @Expose
    public int total_price;

    @SerializedName("status")
    @Expose
    public int status;

    @SerializedName("registration_code")
    @Expose
    public String registration_code;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("payment")
    @Expose
    public PaymentResponse payment;

    @SerializedName("dokter")
    @Expose
    public DokterResponse dokter;


}
