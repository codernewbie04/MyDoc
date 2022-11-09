package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.data.remote.entities.ListDokterResponse;
import com.kelompok1.mydoc.databinding.ItemListDokterBinding;
import com.kelompok1.mydoc.ui.booking_order.BookingOrderAct;
import com.kelompok1.mydoc.utils.CommonUtils;

import java.util.List;

public class ListDokterAdapter extends RecyclerView.Adapter<ListDokterAdapter.ViewHolder>{
    List<ListDokterResponse> dataList;
    Context mContext;

    public ListDokterAdapter(List<ListDokterResponse> dataList, Context mContext) {
        this.dataList = dataList;
        this.mContext = mContext;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        ItemListDokterBinding binding = ItemListDokterBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false);
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
        public ItemListDokterBinding itemView;

        public ViewHolder(@NonNull ItemListDokterBinding itemView) {
            super(itemView.getRoot());
            this.itemView = itemView;
        }

        public void bind(ListDokterResponse data) {
            itemView.txtNamaDokter.setText(data.nama);
            itemView.txtProfession.setText(data.profession);
            itemView.txtInstansi.setText(data.instansi);
            itemView.txtPrice.setText(CommonUtils.convertToRp(data.price));
            itemView.rating.setRating(data.review.rating_average);
            itemView.txtAvgRating.setText(String.valueOf(data.review.rating_average));
            itemView.txtCountRating.setText("( "+ data.review.rating_count +" ulasan)");
            itemView.getRoot().setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    mContext.startActivity(new Intent(mContext, BookingOrderAct.class));
                }
            });
        }
    }
}
