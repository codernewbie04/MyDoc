package com.kelompok1.mydoc.data.remote.request;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class EditPasswordRequest {
    @SerializedName("old_password")
    @Expose
    public String old_password;

    @SerializedName("new_password1")
    @Expose
    public String new_password1;

    @SerializedName("new_password2")
    @Expose
    public String new_password2;

    public EditPasswordRequest(){}

    public EditPasswordRequest(String old_password, String new_password1, String new_password2) {
        this.old_password = old_password;
        this.new_password1 = new_password1;
        this.new_password2 = new_password2;
    }
}
