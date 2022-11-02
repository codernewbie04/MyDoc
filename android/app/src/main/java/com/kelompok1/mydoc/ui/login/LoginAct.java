package com.kelompok1.mydoc.ui.login;

import androidx.annotation.NonNull;

import android.content.Context;
import android.content.Intent;
import android.view.View;

import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.databinding.ActivityLoginBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.utils.FieldValidator;
import com.kelompok1.mydoc.ui.dashboard.MainAct;
import com.shashank.sony.fancytoastlib.FancyToast;

public class LoginAct extends BaseActivity<LoginPresenter> implements LoginView {
    private Context mContext;
    private ActivityLoginBinding binding;
    @NonNull
    @Override
    protected LoginPresenter createPresenter() {
        return new LoginPresenter( this);
    }

    @Override
    public void initView() {
        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        mContext = this;
        binding.btnMasuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!FieldValidator.isNull(binding.etEmail) && !FieldValidator.invalidEmail(binding.etEmail) &&!FieldValidator.invalidEmail(binding.etEmail) && !FieldValidator.isNull(binding.etPassword)) {
                    hideKeyboard();
                    showLoading();
                    presenter.login(binding.etEmail.getEditText().getText().toString(), binding.etPassword.getEditText().getText().toString());
                }
            }
        });
    }

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void toastMsg(String msg, int status) {
        hideLoading();
        FancyToast.makeText(mContext, msg, FancyToast.LENGTH_SHORT, status, false).show();
    }

    @Override
    public void formError(LoginErrorResponse form_error) {
        hideLoading();
        if(form_error.getFcm_token() != null)
            toastMsg("Token bermasalah!", FancyToast.ERROR);

        if(form_error.getEmail() != null)
            binding.etEmail.setHelperText(form_error.getEmail());

        if(form_error.getPassword() != null)
            binding.etPassword.setHelperText(form_error.getPassword());
    }

    @Override
    public void successLogin() {
        startActivity(new Intent(mContext, MainAct.class));
    }
}