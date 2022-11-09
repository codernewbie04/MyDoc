package com.kelompok1.mydoc.ui.base;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.google.android.material.bottomsheet.BottomSheetDialogFragment;
import com.kelompok1.mydoc.databinding.SheetPaymentMethodBinding;

public abstract class BaseBottomFragment<Presenter extends BasePresenter> extends BottomSheetDialogFragment {
    protected Presenter presenter;

    @NonNull
    protected abstract Presenter createPresenter();


    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        presenter = createPresenter();
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        return super.onCreateView(inflater, container, savedInstanceState);
    }
}

