package com.kelompok1.mydoc.ui.login;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.data.remote.request.LoginRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.shashank.sony.fancytoastlib.FancyToast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginPresenter extends BasePresenter<LoginView> {
    protected LoginPresenter(LoginView view) {
        super(view);
    }

    public void login(String email, String password){
        ((MvpApp) view.getContext().getApplicationContext()).getAuthService().login(new LoginRequest(email, password, "123")).enqueue(new Callback<BaseApiResponse<LoginResponse, LoginErrorResponse>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<LoginResponse, LoginErrorResponse>> call, Response<BaseApiResponse<LoginResponse, LoginErrorResponse>> response) {
                if(response.isSuccessful()){
                    assert response.body() != null;
                    ((MvpApp) view.getContext().getApplicationContext()).getSession().saveToken(response.body().getData().token);
                    ((MvpApp) view.getContext().getApplicationContext()).getSession().saveUserData(response.body().getData().user);
                    view.successLogin();
                } else {

                    BaseApiResponse<LoginResponse, LoginErrorResponse> errResponse = CommonUtils.parseError(response, new TypeToken<BaseApiResponse<LoginResponse, LoginErrorResponse>>() {}.getType());
                    if(errResponse.getForm_error() == null){
                        view.toastMsg(errResponse.getMessage(), FancyToast.ERROR);
                    } else {
                        view.formError(errResponse.getForm_error());
                    }

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<LoginResponse, LoginErrorResponse>> call, Throwable t) {
                view.toastMsg(t.getMessage(), FancyToast.ERROR);
            }
        });
    }
}
