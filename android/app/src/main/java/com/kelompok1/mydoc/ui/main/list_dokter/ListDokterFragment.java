package com.kelompok1.mydoc.ui.main.list_dokter;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.navigation.Navigation;
import androidx.recyclerview.widget.LinearLayoutManager;


import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.HistoryAdapter;
import com.kelompok1.mydoc.adapter.ListDokterAdapter;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.FragmentListDokterBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.ui.main.dashboard.DashboardPresenter;
import com.kelompok1.mydoc.ui.main.dashboard.DashboardView;

import java.util.List;


public class ListDokterFragment extends BaseFragment<ListDokterPresenter> implements ListDokterView {

    private FragmentListDokterBinding binding;


    @NonNull
    @Override
    protected ListDokterPresenter createPresenter() {
        return new ListDokterPresenter(this);
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentListDokterBinding.inflate(inflater, container, false);
        View root = binding.getRoot();


        Window window = getActivity().getWindow();
        window.clearFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
        window.setStatusBarColor(getResources().getColor(R.color.white));
        window.getDecorView().setSystemUiVisibility(View.SYSTEM_UI_FLAG_LIGHT_STATUS_BAR);
        presenter = createPresenter();
        initView();
        return root;
    }

    @Override
    public void initView() {
        presenter.getListDokter();
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
    public void dokterLoaded(List<DetailDokterResponse> dokter) {
        binding.rvListdokter.setHasFixedSize(true);
        binding.rvListdokter.setNestedScrollingEnabled(false);
        binding.rvListdokter.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvListdokter.setAdapter(new ListDokterAdapter(dokter, getContext()));
        binding.pbListDokter.setVisibility(View.GONE);
        if(dokter.size() <= 0){
            binding.emptyState.setVisibility(View.VISIBLE);
        }
    }
}