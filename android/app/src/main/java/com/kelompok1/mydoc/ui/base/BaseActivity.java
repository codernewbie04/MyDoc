package com.kelompok1.mydoc.ui.base;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.view.inputmethod.InputMethodManager;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.kelompok1.mydoc.utils.CommonUtils;

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

    public void showSuccessMessage(String msg)
    {
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show();
    }

    public void showErrorMessage(String msg){
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show();
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

    public void showLoading() {
        hideLoading();
        hideKeyboard();
        mProgressDialog = CommonUtils.showLoadingDialog(this);
    }

    public void hideLoading() {
        if (mProgressDialog != null && mProgressDialog.isShowing()) {
            mProgressDialog.cancel();
        }
    }

    public void setColorStatusBar(int color, int iconStatusBar){
        Window window = getWindow();
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
        window.setStatusBarColor(getResources().getColor(color));
        window.getDecorView().setSystemUiVisibility(iconStatusBar);
    }
}
