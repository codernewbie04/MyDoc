package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.viewpager.widget.PagerAdapter;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.databinding.ItemOnBoardingBinding;
import com.kelompok1.mydoc.data.local.model.OnBoardingUIModel;

import java.util.List;

public class OnBoardingAdapter extends PagerAdapter {
    private final Context mContext;
    private final List<OnBoardingUIModel> models;

    public OnBoardingAdapter(Context context, List<OnBoardingUIModel> m){
        mContext = context;
        models = m;
    }

    @Override
    public Object instantiateItem(ViewGroup collection, int position) {
        LayoutInflater inflater = LayoutInflater.from(mContext);
        ViewGroup layout = (ViewGroup) inflater.inflate(R.layout.item_on_boarding, collection, false);
        ItemOnBoardingBinding binding = ItemOnBoardingBinding.bind(layout);
        collection.addView(layout);
        binding.textTitle.setText(models.get(position).getTitle());
        binding.textSubTitle.setText(models.get(position).getSubTitle());
        return layout;
    }

    @Override
    public void destroyItem(ViewGroup collection, int position, Object view) {
        collection.removeView((View) view);
    }

    @Override
    public int getCount() {
        return (null != models ? models.size() : 0);
    }

    @Override
    public boolean isViewFromObject(@NonNull View view, @NonNull Object object) {
        return view == object;
    }
}
