package com.kelompok1.mydoc.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.databinding.ItemHistoryBinding;

import java.util.List;

public class HistoryAdapter  extends RecyclerView.Adapter<HistoryAdapter.ViewHolder>{
    private List<HistoryResponse> dataList;
    private Context mContext;

    public HistoryAdapter(List<HistoryResponse> dataList, Context mContext) {
        this.dataList = dataList;
        this.mContext = mContext;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        ItemHistoryBinding binding = ItemHistoryBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false);
        return new ViewHolder(binding);
    }

    @SuppressLint({"UseCompatLoadingForColorStateLists", "SetTextI18n"})
    @Override
    public void onBindViewHolder(@NonNull HistoryAdapter.ViewHolder holder, int position) {
        HistoryResponse data = dataList.get(position);
        holder.bind(data);
    }

    @Override
    public int getItemCount() {
        return (null != dataList ? dataList.size() : 0);
    }

    class ViewHolder extends RecyclerView.ViewHolder {
        public ItemHistoryBinding itemView;
        public ViewHolder(@NonNull ItemHistoryBinding itemView) {
            super(itemView.getRoot());
            this.itemView = itemView;
        }

        public void bind(HistoryResponse data){
            itemView.txtTanggal.setText(data.created_at);
            if (data.dokter != null){
                itemView.txtFullname.setText(data.dokter.nama);
                itemView.txtProfesi.setText(data.dokter.profession);
            }

            int statusCode = data.status;
            switch (statusCode){
                case 0:
                    itemView.status.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.orange));
                    itemView.status.setText("Pending");
                    break;
                case 1:
                    itemView.status.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.green_success));
                    itemView.status.setText("Dalam Antrian");
                    break;
                case 2:
                    itemView.status.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.green_success));
                    itemView.status.setText("Selesai");
                    break;
                case -3:
                case -4:
                case -5:
                    itemView.status.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.red_400));
                    break;

            }
        }
    }
}
