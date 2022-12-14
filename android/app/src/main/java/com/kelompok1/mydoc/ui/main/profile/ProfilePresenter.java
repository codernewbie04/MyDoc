package com.kelompok1.mydoc.ui.main.profile;

import android.util.Log;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfilePresenter extends BasePresenter<ProfileView> {
    protected ProfilePresenter(@NonNull ProfileView view) {
        super(view);
    }

    public void getUser()
    {
        ((MvpApp) view.getContext().getApplicationContext()).getProfileService().getUser().enqueue(new Callback<BaseApiResponse<UserResponse, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<UserResponse, Nullable>> call, Response<BaseApiResponse<UserResponse, Nullable>> response) {
                if(response.isSuccessful()){
                    if(response.body().getData() != null){
                        if(view != null) {
                            view.loadUser(response.body().getData());
                            try {
                                MvpApp app = (MvpApp) view.getContext().getApplicationContext();
                                if(app != null)
                                    app.getSession().saveUserData(response.body().getData());
                            } catch (Exception e){
                                Log.d("error_presenter", e.getMessage());
                            }


                        }
                    }
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<UserResponse, Nullable>> call, Throwable t) {

            }
        });
    }

    public void logout()
    {
        ((MvpApp) view.getContext().getApplicationContext()).getAuthService().logout().enqueue(new Callback<BaseApiResponse<Nullable, Nullable>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<Nullable, Nullable>> call, Response<BaseApiResponse<Nullable, Nullable>> response) {
                if(response.isSuccessful()){
                    if(view != null) {
                        ((MvpApp) view.getContext().getApplicationContext()).getSession().goLogout();
                        view.goLogout();
                    }
                } else {

                }

            }

            @Override
            public void onFailure(Call<BaseApiResponse<Nullable, Nullable>> call, Throwable t) {
            }
        });
    }


}
