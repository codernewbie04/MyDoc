package com.kelompok1.mydoc.ui.edit_profile;

import com.kelompok1.mydoc.data.remote.request.EditProfileRequest;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface EditProfileView extends BaseView {
    void successUpdate(String msg);
    void formError(EditProfileRequest error);
}
