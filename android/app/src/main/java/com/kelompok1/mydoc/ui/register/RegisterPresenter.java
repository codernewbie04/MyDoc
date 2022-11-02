package com.kelompok1.mydoc.ui.register;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.RegisterErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.RegisterResponse;
import com.kelompok1.mydoc.data.remote.request.RegisterRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.shashank.sony.fancytoastlib.FancyToast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterPresenter extends BasePresenter<RegisterView> {
    protected RegisterPresenter(RegisterView view) {
        super(view);
    }

    public void register(String fullname, String email, String bday, String address, String p1, String p2){
        ((MvpApp) view.getContext().getApplicationContext()).getAuthService().register(new RegisterRequest(fullname, email, bday, address,p1,p2)).enqueue(new Callback<BaseApiResponse<RegisterResponse, RegisterErrorResponse>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<RegisterResponse, RegisterErrorResponse>> call, Response<BaseApiResponse<RegisterResponse, RegisterErrorResponse>> response) {
                if(response.isSuccessful()){
                    view.successRegister(response.body().getMessage());
                } else {
                    BaseApiResponse<RegisterResponse, RegisterErrorResponse> errResponse = CommonUtils.parseError(response, new TypeToken<BaseApiResponse<RegisterResponse, RegisterErrorResponse>>() {}.getType());
                    if(errResponse.getForm_error() == null){
                        view.toastMsg(errResponse.getMessage(), FancyToast.ERROR);
                    } else {
                        view.formError(errResponse.getForm_error());
                    }
                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<RegisterResponse, RegisterErrorResponse>> call, Throwable t) {
                view.toastMsg(t.getMessage(), FancyToast.ERROR);
            }
        });
    }
}
