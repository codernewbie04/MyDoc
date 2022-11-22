package com.kelompok1.mydoc.ui.edit_password;

import androidx.annotation.Nullable;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.data.remote.request.EditPasswordRequest;
import com.kelompok1.mydoc.data.remote.request.EditProfileRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.kelompok1.mydoc.utils.CommonUtils;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditPasswordPresenter extends BasePresenter<EditPasswordView> {
    protected EditPasswordPresenter(EditPasswordView view) {
        super(view);
    }

    void updatePassword(String oldPassword, String newPassword, String newPassword2)
    {
        ((MvpApp) view.getContext().getApplicationContext()).getProfileService().editPassword(new EditPasswordRequest(oldPassword, newPassword, newPassword2)).enqueue(new Callback<BaseApiResponse<Nullable, EditPasswordRequest>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<Nullable, EditPasswordRequest>> call, Response<BaseApiResponse<Nullable, EditPasswordRequest>> response) {
                if(response.isSuccessful()){
                    view.successUpdate(response.body().getMessage());
                } else {
                    BaseApiResponse<Nullable, EditPasswordRequest> errResponse = CommonUtils.parseError(response, new TypeToken<BaseApiResponse<Nullable, EditPasswordRequest>>() {}.getType());
                    view.onError(errResponse.getMessage());
                    view.formError(errResponse.getForm_error());
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<Nullable, EditPasswordRequest>> call, Throwable t) {
                view.onError(t.getMessage());
            }
        });
    }
}
