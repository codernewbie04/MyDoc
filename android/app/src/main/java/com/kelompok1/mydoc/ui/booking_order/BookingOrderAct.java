package com.kelompok1.mydoc.ui.booking_order;

import androidx.annotation.NonNull;
import androidx.navigation.NavController;
import androidx.navigation.fragment.NavHostFragment;

import android.content.Context;
import android.os.Bundle;
import android.view.View;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.ui.base.BaseActivity;

public class BookingOrderAct extends BaseActivity<DetailDokterPresenter> implements DetailDokterView {
    Context mContext;
    @NonNull
    @Override
    protected DetailDokterPresenter createPresenter() {
        return new DetailDokterPresenter(this);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_dokter);
        NavHostFragment navHostFragment =
                (NavHostFragment) getSupportFragmentManager().findFragmentById(R.id.nav_host_fragment);

        Bundle extras = getIntent().getExtras();
        int dokter_id = -1;
        if (extras != null) {
            dokter_id = extras.getInt("dokter_id");
            //The key argument here must match that used in the other activity
        }
        Bundle bundle = new Bundle();
        bundle.putInt("dokter_id", dokter_id);
        navHostFragment.setArguments(bundle);
        NavController navController = navHostFragment.getNavController();

    }

    @Override
    public void initView() {
        mContext = this;
    }

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void onError(String msg) {

    }
}