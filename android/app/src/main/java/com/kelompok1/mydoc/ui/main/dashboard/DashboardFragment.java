package com.kelompok1.mydoc.ui.main.dashboard;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.HistoryAdapter;
import com.kelompok1.mydoc.adapter.MyReviewAdapter;
import com.kelompok1.mydoc.adapter.sheet.ListReviewsSheet;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.FragmentDashboardBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.utils.CommonUtils;

import java.util.ArrayList;
import java.util.List;


public class DashboardFragment extends BaseFragment<DashboardPresenter> implements DashboardView {

    private FragmentDashboardBinding binding;


    @NonNull
    @Override
    protected DashboardPresenter createPresenter() {
        return new DashboardPresenter(this, getContext());
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentDashboardBinding.inflate(inflater, container, false);
        View root = binding.getRoot();
        Window window = getActivity().getWindow();
        window.clearFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
        window.setStatusBarColor(getResources().getColor(R.color.blue_main));
        window.getDecorView().setSystemUiVisibility(0);
        presenter = createPresenter();
        initView();
        presenter.getDasbhoard();
        return root;
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }

    @Override
    public void onUserLoggedOut() {

    }

    @Override
    public void initView() {
        UserResponse userData = ((MvpApp) getContext().getApplicationContext()).getSession().getUserData();
        String name = CommonUtils.getFirstName(userData.fullname);
        binding.txtHeading.setText(binding.txtHeading.getText().toString().replace("{{user}}", name));
        binding.txtSaldo.setText(CommonUtils.convertToRp(userData.balance));
        binding.swipeToRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                presenter.getDasbhoard();
            }
        });
    }

    @Override
    public void setUser(UserResponse user) {
        if(user != null){
            String name = user.fullname.split(" ", -2)[0];
            binding.txtHeading.setText("Hi "+name+", Selamat Datang di MyDoc!");
            binding.txtSaldo.setText(CommonUtils.convertToRp(user.balance));
        }


    }

    @Override
    public void setHistory(List<HistoryResponse> history) {
        binding.rvHistory.setHasFixedSize(true);
        binding.rvHistory.setNestedScrollingEnabled(false);
        binding.rvHistory.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvHistory.setAdapter(new HistoryAdapter(history, getContext()));
        binding.pbHistory.setVisibility(View.GONE);
        if(history.size() <= 0){
            binding.nodataHistory.setVisibility(View.VISIBLE);
        }
    }

    @Override
    public void setMyReview(List<MyReviewResponse> my_review) {
        List<MyReviewResponse> max5Review = new ArrayList<>();
        if(my_review.size() > 5){
            for(int i =0; i < 5; i ++){
                max5Review.add(my_review.get(i));
            }
        } else {
            max5Review.addAll(my_review);
        }


        binding.rvReview.setHasFixedSize(true);
        binding.rvReview.setNestedScrollingEnabled(false);
        binding.rvReview.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvReview.setAdapter(new MyReviewAdapter(max5Review));
        binding.pbRating.setVisibility(View.GONE);
        binding.ratingCount.setText("("+ my_review.size() +" ulasan diberikan)");
        binding.btnLihatSemua.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new ListReviewsSheet(my_review).show(getActivity().getSupportFragmentManager(),"MyReview");
            }
        });
        if(my_review.size() <= 0){
            binding.nodataReview.setVisibility(View.VISIBLE);
        }
        binding.swipeToRefreshLayout.setRefreshing(false);
    }
}