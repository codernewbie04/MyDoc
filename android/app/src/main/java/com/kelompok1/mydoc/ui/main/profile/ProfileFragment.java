package com.kelompok1.mydoc.ui.main.profile;

import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.FragmentProfileBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.ui.edit_profile.EditProfileAct;
import com.kelompok1.mydoc.ui.onboarding.OnBoardingAct;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.shashank.sony.fancytoastlib.FancyToast;

public class ProfileFragment extends BaseFragment<ProfilePresenter> implements ProfileView{
    FragmentProfileBinding binding;

    @NonNull
    @Override
    protected ProfilePresenter createPresenter() {
        return new ProfilePresenter(this);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentProfileBinding.inflate(inflater, container, false);
        presenter = createPresenter();
        initView();
        return binding.getRoot();
    }

    @Override
    public void onUserLoggedOut() {

    }

    @Override
    public void onResume() {
        super.onResume();
        presenter.getUser();
    }

    @Override
    public void initView() {
        UserResponse userData = ((MvpApp) getContext().getApplicationContext()).getSession().getUserData();
        if(userData.fullname !=null)
            binding.txtFullname.setText(userData.fullname);
        if(userData.fullname !=null)
            binding.txtFullname2.setText(userData.fullname);
        if(userData.email !=null){
            binding.txtEmail.setText(userData.email);
            binding.txtEmail2.setText(userData.email);
        }
        binding.txtBalance.setText(CommonUtils.convertToRp(userData.balance));
        if(userData.address !=null)
            binding.txtAddress.setText(userData.address);
        if(userData.birthday !=null)
            binding.txtBirtday.setText(userData.birthday);



        binding.btnProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getContext(), EditProfileAct.class));
            }
        });

        binding.llKeluar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                presenter.logout();
            }
        });

    }

    @Override
    public void loadUser(UserResponse user) {
        if(user.fullname !=null)
            binding.txtFullname.setText(user.fullname);
        if(user.fullname !=null)
            binding.txtFullname2.setText(user.fullname);
        if(user.email !=null){
            binding.txtEmail.setText(user.email);
            binding.txtEmail2.setText(user.email);
        }
        binding.txtBalance.setText(CommonUtils.convertToRp(user.balance));
        if(user.address !=null)
            binding.txtAddress.setText(user.address);
        if(user.birthday !=null)
            binding.txtBirtday.setText(user.birthday);
    }

    @Override
    public void goLogout() {
        FancyToast.makeText(getContext(), "Berhasil logout", FancyToast.LENGTH_SHORT, FancyToast.SUCCESS, false).show();
        getActivity().finishAffinity();
        startActivity(new Intent(getContext(), OnBoardingAct.class));
    }
}