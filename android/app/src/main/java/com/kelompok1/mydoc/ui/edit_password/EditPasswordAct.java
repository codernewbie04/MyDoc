package com.kelompok1.mydoc.ui.edit_password;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.request.EditPasswordRequest;
import com.kelompok1.mydoc.databinding.ActivityEditPasswordBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.utils.FieldValidator;

public class EditPasswordAct extends BaseActivity<EditPasswordPresenter> implements EditPasswordView {
    private ActivityEditPasswordBinding binding;
    private Context mContext;
    @NonNull
    @Override
    protected EditPasswordPresenter createPresenter() {
        return new EditPasswordPresenter(this);
    }

    @Override
    public void initView() {
        binding = ActivityEditPasswordBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        mContext = this;
        binding.btnSimpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(!FieldValidator.isNull(binding.etPasswordLama) && !FieldValidator.isNull(binding.etPassword) && !FieldValidator.isNull(binding.etPasswordKonfirmasi) && FieldValidator.isSamePassword(binding.etPassword, binding.etPasswordKonfirmasi)){
                    showLoading();
                    presenter.updatePassword(binding.etPasswordLama.getEditText().getText().toString(), binding.etPassword.getEditText().getText().toString(), binding.etPasswordKonfirmasi.getEditText().getText().toString());
                }
            }
        });
    }

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void successUpdate(String msg) {
        hideLoading();
        showSuccessMessage(msg);
        finish();
    }

    @Override
    public void onError(String msg) {
        hideLoading();
        showErrorMessage(msg);
    }

    @Override
    public void formError(EditPasswordRequest error) {
        hideLoading();
        if(error != null){
            if(error.old_password !=null)
                binding.etPasswordLama.setHelperText(error.old_password);
            if(error.new_password1 !=null)
                binding.etPassword.setHelperText(error.new_password1);
            if(error.new_password2 !=null)
                binding.etPasswordKonfirmasi.setHelperText(error.new_password2);
        }
    }
}