package com.kelompok1.mydoc.ui.invoice;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.ClipData;
import android.content.ClipboardManager;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.Point;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.InvoiceResponse;
import com.kelompok1.mydoc.databinding.ActivityInvoiceBinding;
import com.kelompok1.mydoc.ui.base.BaseActivity;
import com.kelompok1.mydoc.ui.give_rating.GiveRatingAct;
import com.kelompok1.mydoc.ui.register.RegisterAct;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.kelompok1.mydoc.utils.PicassoTrustAll;

import androidmads.library.qrgenearator.QRGContents;
import androidmads.library.qrgenearator.QRGEncoder;

public class InvoiceAct extends BaseActivity<InvoicePresenter> implements InvoiceView {
    private ActivityInvoiceBinding binding;
    private Context mContext;
    @NonNull
    @Override
    protected InvoicePresenter createPresenter() {
        return new InvoicePresenter(this);
    }

    @Override
    public void initView() {
        binding = ActivityInvoiceBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        binding.include.txtTitle.setText("Invoice");
        mContext = this;
        int invoice_id = getIntent().getExtras().getInt("invoice_id",0);
        showLoading();
        presenter.getInvoice(invoice_id);
        binding.btnDone.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        binding.include.toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    @Override
    public Context getContext() {
        return mContext;
    }

    @Override
    public void onError(String msg) {
        finish();
        showErrorMessage(msg);
    }

    @Override
    public void loadInvoice(InvoiceResponse data) {
        hideLoading();
        PicassoTrustAll.getInstance(mContext).load(data.dokter.image).resize(500,500).placeholder(R.drawable.image_placeholder).centerInside().into(binding.imgDokter);
        if(data.payment != null) {
            if (data.payment.payment_method != null) {
                binding.txtPaymentMethod.setText(data.payment.payment_method.paymentName);
                PicassoTrustAll.getInstance(mContext).load(data.payment.payment_method.paymentImage).resize(100,100).placeholder(R.drawable.image_placeholder).centerInside().into(binding.imgPaymentMethod);
            }
            switch (data.payment.status) {
                case 0:
                    binding.txtStatusPembayaran.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.orange));
                    binding.txtStatusPembayaran.setText("Menunggu Pembayaran");
                    break;
                case 1:
                    binding.txtStatusPembayaran.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.green_success));
                    binding.txtStatusPembayaran.setText("Lunas");
                    break;
                case 2:
                case 4:
                case 5:
                case 6:
                    binding.txtStatusPembayaran.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.red_400));
                    binding.txtStatusPembayaran.setText("Gagal");
                    break;
            }

            if (data.payment.vaNumber != null) {
                binding.groupVa.setVisibility(View.VISIBLE);
                binding.txtVa.setText(data.payment.vaNumber);
                binding.btnCopyVa.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        ClipboardManager clipboard = (ClipboardManager) getSystemService(Context.CLIPBOARD_SERVICE);
                        ClipData clip = ClipData.newPlainText("va_number", data.payment.vaNumber);
                        clipboard.setPrimaryClip(clip);
                        Toast.makeText(mContext, "Berhasil disalin", Toast.LENGTH_SHORT).show();
                    }
                });
            }

            if(data.payment.qr_code != null){
                int width = binding.imgQrCode.getWidth();
                int height = binding.imgQrCode.getHeight();
                int dimen = Math.max(width, height) * 10;
                binding.groupQr.setVisibility(View.VISIBLE);
                QRGEncoder qrgEncoder = new QRGEncoder(data.payment.qr_code, null, QRGContents.Type.TEXT, dimen);
                qrgEncoder.setColorBlack(Color.WHITE);
                qrgEncoder.setColorWhite(Color.BLACK);
                try {
                    // Getting QR-Code as Bitmap
                    Bitmap bitmap = qrgEncoder.getBitmap();
                    // Setting Bitmap to ImageView
                    binding.imgQrCode.setImageBitmap(bitmap);
                } catch (Exception  e) {
                    showErrorMessage("Failed load QR:"+e.getMessage());
                }
            }
        } else {
            binding.txtPaymentMethod.setText("-");
            binding.imgPaymentMethod.setVisibility(View.GONE);
            binding.groupStatusPembayaran.setVisibility(View.GONE);
        }

        binding.txtInvoice.setText(data.no_invoice);
        binding.txtPaymentExpired.setText(data.created_at);
        switch (data.status){
            case 0:
                binding.txtStatusPengobatan.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.orange));
                binding.txtStatusPengobatan.setText("Pending");
                break;
            case 1:
                binding.txtStatusPengobatan.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.green_success));
                binding.txtStatusPengobatan.setText("Dalam Antrian");
                binding.btnDone.setEnabled(true);
                binding.btnDone.setText("Selesai");
                break;
            case 2:
                binding.txtStatusPengobatan.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.green_success));
                binding.txtStatusPengobatan.setText("Selesai");
                break;
            case 4:
            case 5:
            case 6:
                binding.txtStatusPengobatan.setBackgroundTintList(mContext.getResources().getColorStateList(R.color.red_400));
                binding.txtStatusPengobatan.setText("Failed");
                break;
        }
        binding.txtAmount.setText(CommonUtils.convertToRp(data.total_price));
        binding.txtRegistrationCode.setText(data.registration_code);
        binding.btnCopyRegistrationCode.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                ClipboardManager clipboard = (ClipboardManager) getSystemService(Context.CLIPBOARD_SERVICE);
                ClipData clip = ClipData.newPlainText("registration_code", data.registration_code);
                clipboard.setPrimaryClip(clip);
                Toast.makeText(mContext, "Berhasil disalin", Toast.LENGTH_SHORT).show();
            }
        });

        binding.txtDokter.setText(data.dokter.nama);
        binding.txtProfession.setText(data.dokter.profession);
        binding.txtJadwal.setText(data.created_at);

        binding.txtPrice.setText(CommonUtils.convertToRp(data.price));
        binding.txtDiskon.setText(CommonUtils.convertToRp(data.discount));
        binding.txtTotal.setText(CommonUtils.convertToRp(data.total_price));

        if(!data.is_rated && data.status == 2){
            Intent i = new Intent(mContext,  GiveRatingAct.class);
            i.putExtra("invoice_id", data.id);
            i.putExtra("img",data.dokter.image);
            i.putExtra("dokter", data.dokter.nama);
            i.putExtra("profession", data.dokter.profession);
            startActivity(i);
        }
    }
}