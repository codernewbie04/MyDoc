package com.kelompok1.mydoc.ui.base;

import androidx.annotation.NonNull;

public class BasePresenter<View extends BaseView> {

    protected View view;

    protected BasePresenter(@NonNull View view) {
        this.view = view;
    }



    public void onDetach() {
        view = null; //avoid memory leak
    }

}