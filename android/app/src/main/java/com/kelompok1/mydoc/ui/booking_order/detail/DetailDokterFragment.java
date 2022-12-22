package com.kelompok1.mydoc.ui.booking_order.detail;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.navigation.NavController;
import androidx.navigation.fragment.NavHostFragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.MyReviewAdapter;
import com.kelompok1.mydoc.adapter.ScheduleAdapter;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.databinding.FragmentDetailDokterBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.utils.CommonUtils;

public class DetailDokterFragment extends BaseFragment<DetailDokterPresenter> implements DetailDokterView {
    FragmentDetailDokterBinding binding;
    @NonNull
    @Override
    protected DetailDokterPresenter createPresenter() {
        return new DetailDokterPresenter(this);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentDetailDokterBinding.inflate(inflater, container, false);
        presenter = createPresenter();
        initView();
        return binding.getRoot();
    }

    @Override
    public void onUserLoggedOut() {

    }

    @Override
    public void initView() {

        showLoading();

        NavHostFragment navHostFragment =
                (NavHostFragment) getActivity().getSupportFragmentManager().findFragmentById(R.id.nav_host_fragment);
        Bundle bundle = navHostFragment.getArguments();
        int dokter_id = -1;
        if (bundle != null) {
            dokter_id = bundle.getInt("dokter_id");
        }
        presenter.getDokter(dokter_id);
        NavController navController = navHostFragment.getNavController();
        int finalDokter_id = dokter_id;
        binding.buttonChat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putInt("dokter_id", finalDokter_id);
                navHostFragment.setArguments(bundle);
                navController.navigate(R.id.action_booking_dokter);
            }
        });

    }

    @Override
    public void onError(String msg) {
        showErrorMessage(msg);
    }

    @Override
    public void loadDetailDokter(DetailDokterResponse dokter) {
        binding.includeProfileDokter.txtNamaDokter.setText(dokter.nama);
        binding.includeProfileDokter.txtProfession.setText(dokter.profession);
        binding.includeProfileDokter.txtPrice.setText(CommonUtils.convertToRp(dokter.price));
        if(dokter.review != null){
            binding.includeProfileDokter.rating.setRating(dokter.review.rating_average);
            binding.includeProfileDokter.txtRating.setText(String.valueOf(dokter.review.rating_average));
            binding.includeProfileDokter.txtCountRating.setText("("+ String.valueOf(dokter.review.rating_count) +" ulasan)");
            binding.includeReview.rvReview.setHasFixedSize(true);
            binding.includeReview.rvReview.setNestedScrollingEnabled(false);
            binding.includeReview.rvReview.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
            binding.includeReview.rvReview.setAdapter(new MyReviewAdapter(dokter.review.ratings));
            binding.includeReview.rating.setRating(dokter.review.rating_average);
            binding.includeReview.txtCountRating.setText("("+ String.valueOf(dokter.review.rating_count) +" ulasan)");
            binding.includeReview.txtAvgRating.setText(String.valueOf(dokter.review.rating_average));
        }
        if(dokter.schedule != null){
            binding.includeSchedule.rvScheduleDokter.setHasFixedSize(true);
            binding.includeSchedule.rvScheduleDokter.setNestedScrollingEnabled(false);
            binding.includeSchedule.rvScheduleDokter.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
            binding.includeSchedule.rvScheduleDokter.setAdapter(new ScheduleAdapter(dokter.schedule, getContext()));
        }

        hideLoading();
    }
}