package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class EditProfileRequest {
    @SerializedName("fullname")
    @Expose
    public String fullname;

    @SerializedName("address")
    @Expose
    public String address;

    @SerializedName("birthday")
    @Expose
    public String birthday;

    public EditProfileRequest() {
    }

    public EditProfileRequest(String fullname, String address, String birthday) {
        this.fullname = fullname;
        this.address = address;
        this.birthday = birthday;
    }
}
