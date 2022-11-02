package com.kelompok1.mydoc.data.prefs;

import android.content.Context;
import android.content.SharedPreferences;

import com.kelompok1.mydoc.abstraction.SharePrefKey;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;

public class PrefManager {
    Context context;

    public PrefManager(Context context) {
        this.context = context;
    }
    public void saveToken(String token){
        SharedPreferences sharedPreferences = context.getSharedPreferences(SharePrefKey.MYDOC_PREF, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString(SharePrefKey.ACCESS_TOKEN, token);
        editor.apply();
    }

    public void saveUserData(UserResponse user){
        SharedPreferences sharedPreferences = context.getSharedPreferences(SharePrefKey.MYDOC_PREF, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt(SharePrefKey.UD_ID, user.id);
        editor.putString(SharePrefKey.UD_Email, user.email);
        editor.putString(SharePrefKey.UD_Fullname, user.fullname);
        editor.putInt(SharePrefKey.UD_Balance, user.balance);
        editor.putString(SharePrefKey.UD_Image, user.image);
        editor.apply();
    }

    public String getToken(){
        return this.getSF().getString(SharePrefKey.ACCESS_TOKEN, "");
    }

    public SharedPreferences getSF(){
        return context.getSharedPreferences(SharePrefKey.MYDOC_PREF, Context.MODE_PRIVATE);
    }

    public void logOut()
    {
        SharedPreferences pref = this.getSF();
        SharedPreferences.Editor editor = pref.edit();
        editor.clear();
        editor.apply();
    }
}
