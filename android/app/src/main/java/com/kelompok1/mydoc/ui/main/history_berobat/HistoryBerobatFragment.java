package com.kelompok1.mydoc.ui.main.history_berobat;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.kelompok1.mydoc.adapter.HistoryAdapter;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.databinding.FragmentHistoryBerobatBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;

import java.util.List;


public class HistoryBerobatFragment extends BaseFragment<HistoryBerobatPresenter> implements HistoryBerobatView {

    private FragmentHistoryBerobatBinding binding;

    @NonNull
    @Override
    protected HistoryBerobatPresenter createPresenter() {
        return new HistoryBerobatPresenter(this);
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentHistoryBerobatBinding.inflate(inflater, container, false);
        View root = binding.getRoot();
        presenter = createPresenter();
        initView();
        return root;
    }


    @Override
    public void onUserLoggedOut() {

    }

    @Override
    public void initView() {
        presenter.getHistoryBerobat();
    }

    @Override
    public void loadHistoryBerobat(List<HistoryResponse> data) {
        binding.rvHistory.setHasFixedSize(true);
        binding.rvHistory.setNestedScrollingEnabled(false);
        binding.rvHistory.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvHistory.setAdapter(new HistoryAdapter(data, getContext()));
        binding.pbHistory.setVisibility(View.GONE);
        if(data.size() <= 0){
            binding.nodataBerobat.setVisibility(View.VISIBLE);
        }
    }
}