package com.kelompok1.mydoc.ui.onboarding;

import androidx.annotation.NonNull;
import androidx.viewpager.widget.ViewPager;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.google.android.material.button.MaterialButton;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.OnBoardingAdapter;
import com.kelompok1.mydoc.databinding.ActivityOnBoardingBinding;
import com.kelompok1.mydoc.model.OnBoardingUIModel;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.ui.login.LoginAct;
import com.kelompok1.mydoc.ui.register.RegisterAct;
import com.tbuonomo.viewpagerdotsindicator.WormDotsIndicator;

import java.util.ArrayList;
import java.util.List;

public class OnBoardingAct extends BaseActivity<OnBoardingPresenter> implements OnBoardingView{
    private ActivityOnBoardingBinding binding;
    Context mContext;

    @NonNull
    @Override
    protected OnBoardingPresenter createPresenter() {
        return new OnBoardingPresenter(this);
    }


    @Override
    public void initView() {
        binding = ActivityOnBoardingBinding.inflate(getLayoutInflater());
        setTheme(R.style.onBoarding);
        setContentView(binding.getRoot());
        mContext = this;


        binding.vPager.setAdapter(new OnBoardingAdapter(mContext, presenter.getSlideModel()));
        binding.dotsIndicator.setViewPager(binding.vPager);

        binding.btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(mContext,  LoginAct.class));
            }
        });

        binding.btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(mContext,  RegisterAct.class));
            }
        });
    }

}