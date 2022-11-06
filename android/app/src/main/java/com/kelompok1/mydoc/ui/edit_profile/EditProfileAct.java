package com.kelompok1.mydoc.ui.edit_profile;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.local.model.Session;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.data.remote.request.EditProfileRequest;
import com.kelompok1.mydoc.databinding.ActivityEditProfileBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.kelompok1.mydoc.utils.FieldValidator;

import java.text.ParseException;

public class EditProfileAct extends BaseActivity<EditProfilePresenter> implements EditProfileView{
    ActivityEditProfileBinding binding;
    Context mContext;
    @NonNull
    @Override
    protected EditProfilePresenter createPresenter() {
        return new EditProfilePresenter(this);
    }

    @Override
    public void initView() {
        Session session = ((MvpApp) getApplication()).getSession();
        UserResponse user = session.getUserData();
        binding = ActivityEditProfileBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        mContext = this;

        binding.includeTb.txtTitle.setText("Edit Profile");


        if(user.fullname != null)
            binding.etFullname.getEditText().setText(user.fullname);
        if(user.birthday != null)
            binding.etBirthday.getEditText().setText(user.birthday);
        if(user.email != null)
            binding.etEmail.getEditText().setText(user.email);
        if(user.address != null)
            binding.etAddress.getEditText().setText(user.address);


        binding.includeTb.toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        binding.etBirthday.getEditText().setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try {
                    CommonUtils.showDateDialog(binding.etBirthday.getEditText(), mContext);
                } catch (ParseException e) {
                    Toast.makeText(mContext, e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        });

        binding.btnSimpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!FieldValidator.isNull(binding.etFullname) && !FieldValidator.isNull(binding.etBirthday) && !FieldValidator.isNull(binding.etAddress)) {
                    showLoading();
                    presenter.editProfile(binding.etFullname.getEditText().getText().toString(), binding.etBirthday.getEditText().getText().toString(), binding.etAddress.getEditText().getText().toString());
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
    public void failedUpdate(String msg) {
        hideLoading();
        showErrorMessage(msg);
    }

    @Override
    public void formError(EditProfileRequest error) {
        hideLoading();
        if(error.fullname !=null)
            binding.etFullname.setHelperText(error.fullname);
        if(error.birthday !=null)
            binding.etBirthday.setHelperText(error.birthday);
        if(error.address !=null)
            binding.etAddress.setHelperText(error.address);
    }
}