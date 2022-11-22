package com.kelompok1.mydoc.ui.base;

import android.content.Context;

public interface BaseView {
    void initView();
    Context getContext();
    void onError(String msg);
}
