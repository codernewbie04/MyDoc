package com.kelompok1.mydoc.ui.onboarding;

import com.kelompok1.mydoc.data.local.model.OnBoardingUIModel;
import com.kelompok1.mydoc.ui.base.BasePresenter;

import java.util.ArrayList;
import java.util.List;

public class OnBoardingPresenter extends BasePresenter<OnBoardingView> {
    protected OnBoardingPresenter(OnBoardingView view) {
        super(view);
    }

    public List<OnBoardingUIModel> getSlideModel(){
        List<OnBoardingUIModel> models = new ArrayList<OnBoardingUIModel>();
        models.add(new OnBoardingUIModel(1, "Buat Janji", "Cari rumah sakit atau dokter terbaik versi\nkamu dengan aplikasi MyDoc"));
        models.add(new OnBoardingUIModel(1, "Buat Janji 2", "Cari rumah sakit atau dokter terbaik versi kamu dengan aplikasi MyDoc"));
        models.add(new OnBoardingUIModel(1, "Buat Janji 3", "Cari rumah sakit atau dokter terbaik versi kamu dengan aplikasi MyDoc"));
        return models;
    }
}
