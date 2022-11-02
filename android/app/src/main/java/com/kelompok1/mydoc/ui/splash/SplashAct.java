package com.kelompok1.mydoc.ui.splash;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.ui.dashboard.MainAct;
import com.kelompok1.mydoc.ui.onboarding.OnBoardingAct;
import com.kelompok1.mydoc.R;

public class SplashAct extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        new Handler().postDelayed(new Runnable() {
            public void run() {
                if(((MvpApp) getApplication()).getSession().isLoggedIn()){
                    startActivity(new Intent(SplashAct.this,  MainAct.class));
                } else {
                    startActivity(new Intent(SplashAct.this,  OnBoardingAct.class));
                }

                finish();
            }
        }, 3000);
    }
}