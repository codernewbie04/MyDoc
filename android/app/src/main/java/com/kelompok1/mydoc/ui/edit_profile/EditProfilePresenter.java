package com.kelompok1.mydoc.ui.edit_profile;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.data.remote.request.EditProfileRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.shashank.sony.fancytoastlib.FancyToast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditProfilePresenter extends BasePresenter<EditProfileView> {
    protected EditProfilePresenter(EditProfileView view) {
        super(view);
    }

    void editProfile(String fullname, String birthday, String address)
    {
        ((MvpApp) view.getContext().getApplicationContext()).getProfileService().editProfile(new EditProfileRequest(fullname, address, birthday)).enqueue(new Callback<BaseApiResponse<UserResponse, EditProfileRequest>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<UserResponse, EditProfileRequest>> call, Response<BaseApiResponse<UserResponse, EditProfileRequest>> response) {
                if(view != null)
                    if(response.isSuccessful()){
                        ((MvpApp) view.getContext().getApplicationContext()).getSession().saveUserData(response.body().getData());
                        view.successUpdate(response.body().getMessage());
                    } else {
                        BaseApiResponse<UserResponse, EditProfileRequest> errResponse = CommonUtils.parseError(response, new TypeToken<BaseApiResponse<UserResponse, EditProfileRequest>>() {}.getType());
                        if(errResponse.getForm_error() == null){
                            view.onError(errResponse.getMessage());
                        } else {
                            view.formError(errResponse.getForm_error());
                        }
                    }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<UserResponse, EditProfileRequest>> call, Throwable t) {
                if(view != null)
                    view.onError(t.getMessage());
            }
        });
    }
}
