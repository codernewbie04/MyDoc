package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.ScheduleResponse;
import com.kelompok1.mydoc.databinding.ItemDokterScheduleBinding;

import java.util.List;

public class ScheduleAdapter extends RecyclerView.Adapter<ScheduleAdapter.ViewHolder>{
    List<ScheduleResponse> dataList;
    Context mContext;

    public ScheduleAdapter(List<ScheduleResponse> data, Context context){
        dataList = data;
        mContext = context;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        ItemDokterScheduleBinding binding = ItemDokterScheduleBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false);
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
        ItemDokterScheduleBinding itemView;
        public ViewHolder(@NonNull ItemDokterScheduleBinding itemView) {
            super(itemView.getRoot());
            this.itemView = itemView;
        }

        void bind(ScheduleResponse data){
            itemView.txtTitle.setText(data.day);
            if(data.id == -1){
                itemView.txtTime.setText("Tidak tersedia");
                itemView.txtTitle.setTextColor(ContextCompat.getColor(mContext, R.color.gray_400));
                itemView.txtTime.setTextColor(ContextCompat.getColor(mContext, R.color.gray_400));
            } else {
                String time = data.time_start+" - "+data.time_end+" WIB";
                itemView.txtTime.setText(time);
            }
        }
    }
}
