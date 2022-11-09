package com.kelompok1.mydoc.ui.onboarding;

import androidx.annotation.NonNull;

import android.content.Context;
import android.content.Intent;
import android.os.Build;
import android.os.Handler;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.OnBoardingAdapter;
import com.kelompok1.mydoc.databinding.ActivityOnBoardingBinding;
import com.kelompok1.mydoc.data.local.model.OnBoardingUIModel;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.ui.login.LoginAct;
import com.kelompok1.mydoc.ui.register.RegisterAct;

import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

public class OnBoardingAct extends BaseActivity<OnBoardingPresenter> implements OnBoardingView{
    private ActivityOnBoardingBinding binding;
    private Context mContext;
    private int currentPage = 0;
    private Timer timer;
    private final long DELAY_MS = 500;//delay in milliseconds before task is to be executed
    private final long PERIOD_MS = 3000;

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
        setColorStatusBar(R.color.black, 0);
        mContext = this;
        List<OnBoardingUIModel> models = presenter.getSlideModel();
        binding.vPager.setAdapter(new OnBoardingAdapter(mContext, models));
        binding.dotsIndicator.setViewPager(binding.vPager);
        setAutoSlide(models);

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

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void onError(String msg) {

    }

    private void setAutoSlide(List<OnBoardingUIModel> models){
        final Handler handler = new Handler();
        final Runnable Update = new Runnable() {
            public void run() {
                if (currentPage == models.size()) {
                    currentPage = 0;
                }
                binding.vPager.setCurrentItem(currentPage++, true);
            }
        };
        timer = new Timer(); // This will create a new Thread
        timer.schedule(new TimerTask() { // task to be scheduled
            @Override
            public void run() {
                handler.post(Update);
            }
        }, DELAY_MS, PERIOD_MS);
    }

}