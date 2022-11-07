package com.kelompok1.mydoc.data.local.model;

import android.content.SharedPreferences;

import com.kelompok1.mydoc.data.remote.entities.UserResponse;

public interface Session {
    void goLogout();
    boolean isLoggedIn();
    void saveToken(String token);
    void saveUserData(UserResponse user);
    UserResponse getUserData();
    String getToken();
    void invalidate();
}