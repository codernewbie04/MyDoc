package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.data.remote.entities.MyReviewResponse;
import com.kelompok1.mydoc.databinding.ItemMyReviewBinding;

import java.util.List;

public class MyReviewAdapter extends RecyclerView.Adapter<MyReviewAdapter.ViewHolder>{
    List<MyReviewResponse> dataList;

    public MyReviewAdapter(List<MyReviewResponse> dataList) {
        this.dataList = dataList;
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

        public void bind(MyReviewResponse data){
            if(data.dokter != null){
                itemView.txtName.setText(data.dokter.nama);
            }
            itemView.ratingView.setRating(data.star);
            itemView.txtReview.setText(data.description);

        }


    }
}
