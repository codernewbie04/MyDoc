package com.kelompok1.mydoc.ui.register;

import androidx.annotation.NonNull;


import android.content.Context;
import android.view.View;

import com.kelompok1.mydoc.utils.FieldValidator;
import com.kelompok1.mydoc.data.remote.entities.RegisterErrorResponse;
import com.kelompok1.mydoc.databinding.ActivityRegisterBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.shashank.sony.fancytoastlib.FancyToast;

public class RegisterAct extends BaseActivity<RegisterPresenter> implements RegisterView {
    private ActivityRegisterBinding binding;
    private Context mContext;
    @NonNull
    @Override
    protected RegisterPresenter createPresenter() {
        return new RegisterPresenter(this);
    }

    @Override
    public void initView() {
        binding = ActivityRegisterBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        mContext = this;

        binding.btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(!FieldValidator.isNull(binding.etFullname) && !FieldValidator.isNull(binding.etEmail) && !FieldValidator.invalidEmail(binding.etEmail) &&
                        !FieldValidator.isNull(binding.etBirthday) && !FieldValidator.isNull(binding.etAddress) && !FieldValidator.isNull(binding.etPassword1) &&
                        FieldValidator.isValidPassword(binding.etPassword1) && !FieldValidator.isNull(binding.etPassword2) && FieldValidator.isSamePassword(binding.etPassword1, binding.etPassword2)){
                    hideKeyboard();
                    showLoading();
                    presenter.register(binding.etFullname.getEditText().getText().toString(), binding.etEmail.getEditText().getText().toString(),
                            binding.etBirthday.getEditText().getText().toString(), binding.etAddress.getEditText().getText().toString(),
                            binding.etPassword1.getEditText().getText().toString(), binding.etPassword2.getEditText().getText().toString());
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
    public void formError(RegisterErrorResponse form_error) {
        hideLoading();
        if(form_error.fullname != null)
            binding.etFullname.setHelperText(form_error.fullname);
        if(form_error.email != null)
            binding.etEmail.setHelperText(form_error.email);
        if(form_error.birthdate != null)
            binding.etBirthday.setHelperText(form_error.birthdate);
        if(form_error.address != null)
            binding.etAddress.setHelperText(form_error.address);
        if(form_error.password1 != null)
            binding.etPassword1.setHelperText(form_error.password2);
        if(form_error.password2 != null)
            binding.etPassword2.setHelperText(form_error.password2);
    }

    @Override
    public void successRegister(String msg) {
        hideLoading();
        this.toastMsg(msg, FancyToast.SUCCESS);
        finish();
    }
}