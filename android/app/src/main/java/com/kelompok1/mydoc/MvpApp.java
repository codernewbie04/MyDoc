package com.kelompok1.mydoc;

import android.app.Application;
import android.content.SharedPreferences;


import com.google.gson.Gson;
import com.kelompok1.mydoc.abstraction.SharePrefKey;
import com.kelompok1.mydoc.data.local.model.Session;
import com.kelompok1.mydoc.data.prefs.PrefManager;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.data.remote.network.AuthorizationInterceptor;
import com.kelompok1.mydoc.data.remote.service.AuthService;
import com.kelompok1.mydoc.data.remote.service.MasterService;
import com.kelompok1.mydoc.data.remote.service.TransactionService;

import java.io.IOException;
import java.util.concurrent.TimeUnit;

import okhttp3.Interceptor;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class MvpApp extends Application {
    private Session session;
    private PrefManager pref;
    private AuthService authService;
    private MasterService masterService;
    private TransactionService transactionService;
    private AuthenticationListener authenticationListener;

    @Override
    public void onCreate() {
        super.onCreate();
        pref = new PrefManager(getApplicationContext());
    }

    public Session getSession() {
        if (session == null) {
            session = new Session() {
                @Override
                public boolean isLoggedIn() {
                    return !getToken().isEmpty();
                }

                @Override
                public void saveToken(String token) {
                    if(token !=null)
                        pref.saveToken(token);
                }

                @Override
                public void saveUserData(UserResponse user) {
                    if(user != null)
                        pref.saveUserData(user);
                }

                @Override
                public UserResponse getUserData() {
                    SharedPreferences sf = pref.getSF();
                    return new UserResponse(sf.getInt(SharePrefKey.UD_ID, -1), sf.getString(SharePrefKey.UD_Email, null),
                            sf.getString(SharePrefKey.UD_Fullname, null), sf.getString(SharePrefKey.UD_Image, null),
                            sf.getInt(SharePrefKey.UD_Balance, 0));
                }


                @Override
                public String getToken() {
                    return pref.getToken();
                }

                @Override
                public void invalidate() {
                    if (authenticationListener != null) {
                        authenticationListener.onUserLoggedOut();
                    }
                }
            };

        }


        return session;
    }

    private Retrofit provideRetrofit(String url) {
        return new Retrofit.Builder()
                .baseUrl(url)
                .client(provideOkHttpClient())
                .addConverterFactory(GsonConverterFactory.create(new Gson()))
                .build();
    }

    private OkHttpClient provideOkHttpClient() {
        OkHttpClient.Builder okhttpClientBuilder = new OkHttpClient.Builder();
        okhttpClientBuilder.connectTimeout(30, TimeUnit.SECONDS);
        okhttpClientBuilder.readTimeout(30, TimeUnit.SECONDS);
        okhttpClientBuilder.writeTimeout(30, TimeUnit.SECONDS);

        //okhttpClientBuilder.addInterceptor(new TokenRenewInterceptor());
        okhttpClientBuilder.addInterceptor(new Interceptor() {
            @Override
            public okhttp3.Response intercept(Chain chain) throws IOException {
                Request original = chain.request();

                Request.Builder requestBuilder = original.newBuilder()
                        .header("Authorization", "Bearer " + getSession().getToken())
                        .method(original.method(), original.body());

                Request request = requestBuilder.build();
                return chain.proceed(request);
            }
        });
        okhttpClientBuilder.addInterceptor(new AuthorizationInterceptor(getAuthServiceForRefresh(), getSession()));
        okhttpClientBuilder.addInterceptor(addLogger());
        return okhttpClientBuilder.build();
    }

    public interface AuthenticationListener {
        void onUserLoggedOut();
    }

    public void setAuthenticationListener(AuthenticationListener listener) {
        this.authenticationListener = listener;
    }

    public AuthService getAuthService() {
        if (authService == null) {
            authService = provideRetrofit(BuildConfig.BASE_URL).create(AuthService.class);
        }
        return authService;
    }

    public AuthService getAuthServiceForRefresh(){
        return provideRetrofitForRefresh(BuildConfig.BASE_URL).create(AuthService.class);
    }

    private Retrofit provideRetrofitForRefresh(String url) {
        return new Retrofit.Builder()
                .baseUrl(url)
                .client(provideOkHttpClientForRefresh())
                .addConverterFactory(GsonConverterFactory.create(new Gson()))
                .build();
    }

    private OkHttpClient provideOkHttpClientForRefresh() {
        OkHttpClient.Builder okhttpClientBuilder = new OkHttpClient.Builder();
        okhttpClientBuilder.connectTimeout(30, TimeUnit.SECONDS);
        okhttpClientBuilder.readTimeout(30, TimeUnit.SECONDS);
        okhttpClientBuilder.writeTimeout(30, TimeUnit.SECONDS);
        okhttpClientBuilder.addInterceptor(new Interceptor() {
            @Override
            public okhttp3.Response intercept(Chain chain) throws IOException {
                Request original = chain.request();

                Request.Builder requestBuilder = original.newBuilder()
                        .header("Authorization", "Bearer " + session.getToken())
                        .method(original.method(), original.body());

                Request request = requestBuilder.build();
                return chain.proceed(request);
            }
        });
        okhttpClientBuilder.addInterceptor(addLogger());
        return okhttpClientBuilder.build();
    }

    public TransactionService getTransactionService(){
        if (transactionService == null) {
            transactionService = provideRetrofit(BuildConfig.BASE_URL).create(TransactionService.class);
        }
        return transactionService;
    }

    public MasterService getMasterService(){
        if (masterService == null) {
            masterService = provideRetrofit(BuildConfig.BASE_URL).create(MasterService.class);
        }
        return masterService;
    }

    public static HttpLoggingInterceptor addLogger(){

        HttpLoggingInterceptor logging = new HttpLoggingInterceptor();

        logging.setLevel(HttpLoggingInterceptor.Level.BODY);
        return logging;
    }
}
