package com.kelompok1.mydoc.ui.register;

import com.kelompok1.mydoc.data.remote.entities.RegisterErrorResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface RegisterView extends BaseView {
    void toastMsg(String msg, int status);
    void formError(RegisterErrorResponse form_error);
    void successRegister(String msg);
}
