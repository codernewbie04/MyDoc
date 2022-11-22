package com.kelompok1.mydoc.adapter;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.databinding.ItemHistoryBinding;
import com.kelompok1.mydoc.ui.invoice.InvoiceAct;

import java.util.List;

public class HistoryAdapter  extends RecyclerView.Adapter<HistoryAdapter.ViewHolder>{
    private List<InvoiceResponse> dataList;
    private Context mContext;

    public HistoryAdapter(List<InvoiceResponse> dataList, Context mContext) {
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
        InvoiceResponse data = dataList.get(position);
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

        @SuppressLint({"SetTextI18n", "UseCompatLoadingForColorStateLists"})
        public void bind(InvoiceResponse data){
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
                case 4:
                case 5:
                case 6:
                    itemView.status.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.red_400));
                    itemView.status.setText("Failed");
                    break;
            }

            itemView.getRoot().setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Activity act = (Activity) mContext;
                    Intent i = new Intent(mContext, InvoiceAct.class);
                    i.putExtra("invoice_id", data.id);
                    act.startActivity(i);
                }
            });
        }
    }
}
