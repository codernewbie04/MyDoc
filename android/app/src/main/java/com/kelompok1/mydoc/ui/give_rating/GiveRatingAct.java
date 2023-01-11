package com.kelompok1.mydoc.ui.give_rating;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.databinding.ActivityGiveRatingBinding;
import com.kelompok1.mydoc.databinding.ActivityInvoiceBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.utils.PicassoTrustAll;
import com.shashank.sony.fancytoastlib.FancyToast;

public class GiveRatingAct extends BaseActivity<GiveRatingPresenter> implements GiveRatingView{
    private ActivityGiveRatingBinding binding;
    private Context mContext;

    @NonNull
    @Override
    protected GiveRatingPresenter createPresenter() {
        return new GiveRatingPresenter(this);
    }

    @Override
    public void initView() {
        binding = ActivityGiveRatingBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        mContext = this;
        binding.include.txtTitle.setText("Nilai Dokter");
        binding.include.toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        binding.ratingBar.setStepSize(1);

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            PicassoTrustAll.getInstance(mContext).load(extras.getString("img")).resize(500,500).placeholder(R.drawable.image_placeholder).centerInside().into(binding.imageDokter);
            binding.textDokterName.setText(extras.getString("dokter"));
            binding.textDokterProfession.setText(extras.getString("profession"));
        } else {
            finish();
        }

        binding.buttonSend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(binding.ratingBar.getRating() > 0 && !binding.textInputDesc.getEditText().getText().toString().isEmpty()){
                    showLoading();
                    if (extras != null) {
                        presenter.giveRating(extras.getInt("invoice_id"), (int)binding.ratingBar.getRating(), binding.textInputDesc.getEditText().getText().toString());
                    } else {
                        finish();
                    }

                } else {
                    FancyToast.makeText(mContext, "Harap mengisi rating!", FancyToast.LENGTH_SHORT, FancyToast.ERROR, false).show();
                }
                Toast.makeText(GiveRatingAct.this, "Rate:"+binding.ratingBar.getRating(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void onError(String msg) {
        FancyToast.makeText(mContext, msg, FancyToast.LENGTH_LONG, FancyToast.ERROR, false).show();
        hideLoading();
        finish();
    }

    @Override
    public void onResponse(boolean status) {
        FancyToast.makeText(mContext, "Berhasil mengisi rating!", FancyToast.LENGTH_LONG, FancyToast.ERROR, false).show();
        hideLoading();
        finish();
    }
}