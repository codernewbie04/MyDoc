package com.kelompok1.mydoc.ui.main.profile;

import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

public interface ProfileView extends BaseView {
    void loadUser(UserResponse user);
    void goLogout();
}
