package com.kelompok1.mydoc.ui.base;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.kelompok1.mydoc.MvpApp;

public abstract class BaseActivity<Presenter extends BasePresenter> extends AppCompatActivity {
    private ProgressDialog mProgressDialog;
    protected Presenter presenter;

    @NonNull
    protected abstract Presenter createPresenter();

    @Override
    protected void onCreate(final Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        presenter = createPresenter();
        presenter.view.initView();
        //((MvpApp) getApplication()).setAuthenticationListener(this);
    }


    @Override
    public void onDestroy() {
        super.onDestroy();
        presenter.onDetach();
    }

    public void showErrorMessage(String msg){
        Toast.makeText(this, "Test", Toast.LENGTH_SHORT).show();
    }

    public void hideKeyboard() {
        View view = this.getCurrentFocus();
        if (view != null) {
            InputMethodManager imm = (InputMethodManager) getSystemService(Context.INPUT_METHOD_SERVICE);
            if (imm != null) {
                imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
            }
        }
    }
}
