package com.kelompok1.mydoc.data.remote.entities;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class BaseApiResponse<DATA, ERROR>{
    @SerializedName("message")
    @Expose
    public String message;

    @SerializedName("data")
    @Expose
    private DATA data;

    @SerializedName("form_error")
    @Expose
    public ERROR form_error;

    public void setMessage(String message) {
        this.message = message;
    }

    public String getMessage() {
        return message;
    }

    public DATA getData() {
        return data;
    }

    public ERROR getForm_error() {
        return form_error;
    }
}
