package com.kelompok1.mydoc.ui.detail_dokter;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.ui.base.BaseActivity;

public class DetailDokterAct extends BaseActivity<DetailDokterPresenter> implements DetailDokterView {
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
    }

    @Override
    public void initView() {
        mContext = this;
    }

    @Override
    public Context getContext() {
        return mContext;
    }
}