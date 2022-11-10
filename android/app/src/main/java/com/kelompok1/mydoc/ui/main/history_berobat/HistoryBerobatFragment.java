package com.kelompok1.mydoc.ui.main.history_berobat;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.HistoryAdapter;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.databinding.FragmentHistoryBerobatBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.onurkagan.ksnack_lib.Animations.Slide;
import com.onurkagan.ksnack_lib.KSnack.KSnack;
import com.shashank.sony.fancytoastlib.FancyToast;

import java.util.List;


public class HistoryBerobatFragment extends BaseFragment<HistoryBerobatPresenter> implements HistoryBerobatView {

    private FragmentHistoryBerobatBinding binding;
    private int max_retry = 3;
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
    public void loadHistoryBerobat(List<InvoiceResponse> data) {
        binding.rvHistory.setHasFixedSize(true);
        binding.rvHistory.setNestedScrollingEnabled(false);
        binding.rvHistory.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvHistory.setAdapter(new HistoryAdapter(data, getContext()));
        binding.pbHistory.setVisibility(View.GONE);
        if(data.size() <= 0){
            binding.nodataBerobat.setVisibility(View.VISIBLE);
        }
    }

    @Override
    public void onError(String msg) {
        KSnack kSnack = new KSnack(getActivity());
        kSnack.setAction("Coba Ulang", new View.OnClickListener() { // name and clicklistener
                    @Override
                    public void onClick(View v) {
                        kSnack.dismiss();
                        if(max_retry <= 0){
                            FancyToast.makeText(getContext(), "Oops! Sepertinya server kami sedang sibuk, coba beberapa saat lagi.", FancyToast.LENGTH_LONG, FancyToast.ERROR, false).show();
                        } else {
                            max_retry--;
                            presenter.getHistoryBerobat();
                        }
                    }
                })
                .setMessage("Error : "+msg) // message
                .setTextColor(R.color.white) // message text color
                .setBackColor(R.color.red_400) // background color
                .setButtonTextColor(R.color.white) // action button text color
                .setAnimation(Slide.Up.getAnimation(kSnack.getSnackView()), Slide.Down.getAnimation(kSnack.getSnackView()))
                .show();
    }
}