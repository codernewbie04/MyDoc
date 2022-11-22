package com.kelompok1.mydoc.ui.edit_password;

import com.kelompok1.mydoc.data.remote.request.EditPasswordRequest;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface EditPasswordView extends BaseView {
    void successUpdate(String msg);
    void formError(EditPasswordRequest error);
}
