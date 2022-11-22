package com.kelompok1.mydoc.ui.login;

import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface LoginView  extends BaseView {
    void toastMsg(String msg, int status);
    void formError(LoginErrorResponse form_error);
    void successLogin();

}
