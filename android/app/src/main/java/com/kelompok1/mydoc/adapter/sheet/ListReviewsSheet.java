package com.kelompok1.mydoc.adapter.sheet;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.google.android.material.bottomsheet.BottomSheetDialogFragment;
import com.kelompok1.mydoc.adapter.MyReviewAdapter;
import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.databinding.SheetListReviewsBinding;

import java.util.List;

public class ListReviewsSheet extends BottomSheetDialogFragment {
    List<MyReviewResponse> dataList;
    SheetListReviewsBinding binding;


    public ListReviewsSheet(List<MyReviewResponse> data ){
        this.dataList = data;
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = SheetListReviewsBinding.inflate(inflater, container, false);
        View root = binding.getRoot();
        binding.rvReview.setHasFixedSize(true);
        binding.rvReview.setNestedScrollingEnabled(false);
        binding.rvReview.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvReview.setAdapter(new MyReviewAdapter(dataList));
        return root;
    }
}
