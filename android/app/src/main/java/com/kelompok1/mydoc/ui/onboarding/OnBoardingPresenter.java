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
        models.add(new OnBoardingUIModel(1, "Bebas Antri", "Langsung daftarkan akun mu di aplikasi MyDoc\nagar menghemat waktumu"));
        models.add(new OnBoardingUIModel(1, "Pelayanan", "Kepuasan anda prioritas kami"));
        models.add(new OnBoardingUIModel(1, "Solusi Kesehatan Terbaik", "Temukan rumah sakit atau dokter terbaik menggunakan aplikasi MyDoc.\nBuat janji dengan mudah dan temukan solusi terbaik untuk kesehatan Anda."));
        return models;
    }
}
