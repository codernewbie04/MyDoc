package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.List;

public class ReviewResponse {
    @SerializedName("rating_average")
    @Expose
    public int rating_average;

    @SerializedName("rating_count")
    @Expose
    public int rating_count;

    @SerializedName("ratings")
    @Expose
    public List<RatingsResponse> ratings = new ArrayList<>();


}
