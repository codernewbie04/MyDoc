package com.kelompok1.mydoc.ui.base;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.prefs.PrefManager;

public abstract class BaseFragment<Presenter extends BasePresenter> extends Fragment implements MvpApp.AuthenticationListener {
    private ProgressDialog mProgressDialog;
    protected Presenter presenter;

    @NonNull
    protected abstract Presenter createPresenter();

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        presenter = createPresenter();
        if (savedInstanceState != null) {
            Log.i("NIL : ", savedInstanceState.toString());
        }
        ((MvpApp) getContext().getApplicationContext()).setAuthenticationListener(this);
        return super.onCreateView(inflater, container, savedInstanceState);
    }

    public void logout()
    {
        Context mContext = getContext();
        new PrefManager(mContext).logOut();
        getActivity().finish();
//        new iOSDialogBuilder(getActivity())
//                .setTitle("Ooops...")
//                .setSubtitle("Sesi telah habis, silakan login ulang.")
//                .setBoldPositiveLabel(true)
//                .setCancelable(false)
//                .setPositiveListener("OK",new iOSDialogClickListener() {
//                    @Override
//                    public void onClick(iOSDialog dialog) {
//                        new PrefManager(mContext).logOut();
//                        startActivity(new Intent(mContext, OnBoardingAct.class)
//                                .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK));
//                        getActivity().finish();
//
//                    }
//                }).build().show();

    }


}