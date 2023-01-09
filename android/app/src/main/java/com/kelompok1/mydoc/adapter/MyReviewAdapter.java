package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.RatingsResponse;
import com.kelompok1.mydoc.databinding.ItemMyReviewBinding;
import com.kelompok1.mydoc.utils.PicassoTrustAll;

import java.util.List;

public class MyReviewAdapter extends RecyclerView.Adapter<MyReviewAdapter.ViewHolder>{
    List<RatingsResponse> dataList;
    private Context mContext;
    public MyReviewAdapter(List<RatingsResponse> dataList, Context context) {
        this.dataList = dataList;
        this.mContext = context;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        ItemMyReviewBinding binding = ItemMyReviewBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false);
        return new ViewHolder(binding);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.bind(dataList.get(position));
    }

    @Override
    public int getItemCount() {
        return (null != dataList ? dataList.size() : 0);
    }


    class ViewHolder extends RecyclerView.ViewHolder {
        public ItemMyReviewBinding itemView;
        public ViewHolder(@NonNull ItemMyReviewBinding itemView) {
            super(itemView.getRoot());
            this.itemView = itemView;
        }

        public void bind(RatingsResponse data){
            if(data.dokter != null){
                itemView.txtName.setText(data.dokter.nama);
                PicassoTrustAll.getInstance(mContext).load(data.dokter.image).resize(100,100).placeholder(R.drawable.image_placeholder).centerInside().into(itemView.dokterImage);
            } else {
                itemView.txtName.setText(data.reviewed_by.fullname);
                PicassoTrustAll.getInstance(mContext).load(data.reviewed_by.image).resize(100,100).placeholder(R.drawable.image_placeholder).centerInside().into(itemView.dokterImage);
            }
            itemView.ratingView.setRating(data.star);
            itemView.txtReview.setText(data.description);

        }


    }
}
