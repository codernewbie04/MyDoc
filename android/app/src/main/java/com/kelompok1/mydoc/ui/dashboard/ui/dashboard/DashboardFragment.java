package com.kelompok1.mydoc.ui.dashboard.ui.dashboard;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.HistoryAdapter;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.FragmentDashboardBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.utils.CommonUtils;

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
        Toast.makeText(getContext(), String.valueOf(history.size()), Toast.LENGTH_SHORT).show();
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

    }
}