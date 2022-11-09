package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class PaymentMethodResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("code")
    @Expose
    public String code;

    @SerializedName("paymentName")
    @Expose
    public String paymentName;

    @SerializedName("paymentImage")
    @Expose
    public String paymentImage;

    @SerializedName("created_at")
    @Expose
    public String created_at;

    @SerializedName("updated_at")
    @Expose
    public String updated_at;
}
