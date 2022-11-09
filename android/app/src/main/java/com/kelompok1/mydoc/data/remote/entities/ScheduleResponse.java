package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class ScheduleResponse {
    @SerializedName("id")
    @Expose
    public int id;

    @SerializedName("dokter_id")
    @Expose
    public int dokter_id;

    @SerializedName("day")
    @Expose
    public String day;

    @SerializedName("time_start")
    @Expose
    public String time_start;

    @SerializedName("time_end")
    @Expose
    public String time_end;

    @SerializedName("created_at")
    @Expose
    public String created_at;
}
