package com.kelompok1.mydoc.ui.base;

public abstract class BasePresenter<View extends BaseView> {

    protected View view;

    protected BasePresenter(View view) {
        this.view = view;
    }



    public void onDetach() {
        view = null; //avoid memory leak
    }

}