package com.kelompok1.mydoc.data.remote.network;

import android.util.Log;

import androidx.annotation.Nullable;

import com.kelompok1.mydoc.data.local.model.Session;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.data.remote.service.AuthService;

import java.io.IOException;

import okhttp3.Interceptor;
import okhttp3.Request;
import okhttp3.Response;

public class AuthorizationInterceptor implements Interceptor {
    private AuthService apiService;
    private Session session;

    public AuthorizationInterceptor(AuthService apiService, Session session) {
        this.apiService = apiService;
        this.session = session;
    }

    @Override
    public Response intercept(Chain chain) throws IOException {
        Response mainResponse = chain.proceed(chain.request());
        Request mainRequest = chain.request();

        if (session.isLoggedIn()) {
            if (mainResponse.code() == 401 || mainResponse.code() == 403) {
                retrofit2.Response<BaseApiResponse<String, Nullable>> refreshToken = apiService.refreshToken().execute();
                BaseApiResponse<String, Nullable> authorization = refreshToken.body();
                if(refreshToken.isSuccessful()){
                    // save the new token
                    if(authorization.getData() !=null)
                        session.saveToken(authorization.getData());

                    Log.d("renew_token", authorization.getData());
                    // retry the 'mainRequest' which encountered an authentication error
                    // add new token into 'mainRequest' header and request again
                    Request.Builder builder = mainRequest.newBuilder().header("Authorization", "Bearer " + session.getToken()).
                            method(mainRequest.method(), mainRequest.body());
                    mainResponse = chain.proceed(builder.build());
                } else {
                    Log.d("logout", "Sesi habis!");
                    session.invalidate();
                }
            }
        }

        return mainResponse;
    }
}

