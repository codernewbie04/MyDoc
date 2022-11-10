package com.kelompok1.mydoc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.databinding.ItemPaymentMethodBinding;
import com.kelompok1.mydoc.ui.booking_order.payment_method.OnPaymentMethodClick;
import com.kelompok1.mydoc.utils.PicassoTrustAll;

import java.util.List;

public class PaymentMethodAdapter extends  RecyclerView.Adapter<PaymentMethodAdapter.ViewHolder>{
    List<PaymentMethodResponse> dataList;
    Context mContext;
    OnPaymentMethodClick mCallbackl;
    public PaymentMethodAdapter(List<PaymentMethodResponse> data, Context context, OnPaymentMethodClick listener)
    {
        data.remove((data.size() - 1));
        dataList = data;
        mContext = context;
        mCallbackl = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        ItemPaymentMethodBinding binding = ItemPaymentMethodBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false);
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
        ItemPaymentMethodBinding itemView;

        public ViewHolder(@NonNull ItemPaymentMethodBinding itemView) {
            super(itemView.getRoot());
            this.itemView = itemView;
        }

        public void bind(PaymentMethodResponse data)
        {
            itemView.txtLabelPaymentMethod.setText(data.paymentName);
            PicassoTrustAll.getInstance(mContext).load(data.paymentImage).resize(100,100).placeholder(R.drawable.image_placeholder).centerInside().into(itemView.imgPaymentMethod);
            itemView.getRoot().setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    mCallbackl.onClick(data);
                }
            });
        }
    }
}
