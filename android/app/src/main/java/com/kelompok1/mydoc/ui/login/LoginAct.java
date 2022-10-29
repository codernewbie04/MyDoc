package com.kelompok1.mydoc.ui.login;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.ui.base.BaseActivity;

public class LoginAct extends BaseActivity<LoginPresenter> implements LoginView {
    private Context mContext;

    @NonNull
    @Override
    protected LoginPresenter createPresenter() {
        return new LoginPresenter( this);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        mContext = this;
    }

    @Override
    public void initView() {

    }
}