package com.kelompok1.mydoc.ui.give_rating;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;
import com.kelompok1.mydoc.data.remote.request.RatingRequest;
import com.kelompok1.mydoc.ui.base.BasePresenter;
import com.kelompok1.mydoc.utils.CommonUtils;

import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class GiveRatingPresenter extends BasePresenter<GiveRatingView> {
    protected GiveRatingPresenter(@NonNull GiveRatingView view) {
        super(view);
    }

    public void giveRating(int id, int star, String desc){
        RatingRequest data = new RatingRequest(id, star, desc);
        ((MvpApp) view.getContext().getApplicationContext()).getTransactionService().giveRating(data).enqueue(new Callback<BaseApiResponse<Nullable, RatingRequest>>() {
            @Override
            public void onResponse(Call<BaseApiResponse<Nullable, RatingRequest>> call, Response<BaseApiResponse<Nullable, RatingRequest>> response) {
                if(response.isSuccessful()){
                    if(view != null)
                        view.onResponse(true);
                } else {
                    try {
                        JSONObject jObjError = new JSONObject(response.errorBody().string());
                        if(view != null)
                            view.onError(jObjError.getString("message"));
                    } catch (Exception e) {
                        if(view != null)
                            view.onError( e.getMessage());
                    }

                }
            }

            @Override
            public void onFailure(Call<BaseApiResponse<Nullable, RatingRequest>> call, Throwable t) {
                if(view != null)
                    view.onError(t.getMessage());
            }
        });
    }
}
