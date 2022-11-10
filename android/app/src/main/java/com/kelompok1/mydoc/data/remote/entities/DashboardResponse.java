package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.List;

public class DashboardResponse {
    @SerializedName("user")
    @Expose
    public UserResponse user;

    @SerializedName("history")
    @Expose
    public List<InvoiceResponse> history = new ArrayList<>();

    @SerializedName("my_review")
    @Expose
    public List<RatingsResponse> my_review = new ArrayList<>();
}
