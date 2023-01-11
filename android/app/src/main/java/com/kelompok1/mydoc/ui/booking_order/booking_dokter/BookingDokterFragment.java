package com.kelompok1.mydoc.ui.booking_order.booking_dokter;

import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.lifecycle.Lifecycle;
import androidx.lifecycle.LifecycleEventObserver;
import androidx.lifecycle.LifecycleOwner;
import androidx.lifecycle.ProcessLifecycleOwner;
import androidx.navigation.NavBackStackEntry;
import androidx.navigation.NavController;
import androidx.navigation.fragment.NavHostFragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.local.model.Session;
import com.kelompok1.mydoc.data.remote.entities.DetailDokterResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.FragmentBookingDokterBinding;
import com.kelompok1.mydoc.ui.base.BaseFragment;
import com.kelompok1.mydoc.ui.invoice.InvoiceAct;
import com.kelompok1.mydoc.utils.CommonUtils;
import com.kelompok1.mydoc.utils.PicassoTrustAll;

public class BookingDokterFragment extends BaseFragment<BookingDokterPresenter> implements BookingDokterView, LifecycleEventObserver {
    FragmentBookingDokterBinding binding;
    private NavController navController;
    private NavBackStackEntry backStackEntry;
    private String paymentCode;
    @NonNull
    @Override
    protected BookingDokterPresenter createPresenter() {
        return new BookingDokterPresenter(this);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentBookingDokterBinding.inflate(getLayoutInflater(), container, false);
        presenter = createPresenter();
        showLoading();
        initView();
        return binding.getRoot();
    }

    @Override
    public void onUserLoggedOut() {

    }

    @Override
    public void initView() {
        binding.include.txtTitle.setText("Pemesanan");
        binding.include.toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getFragmentManager().popBackStackImmediate();
            }
        });
        ProcessLifecycleOwner.get().getLifecycle().addObserver(this);
        NavHostFragment navHostFragment =
                (NavHostFragment) getActivity().getSupportFragmentManager().findFragmentById(R.id.nav_host_fragment);
        navController = navHostFragment.getNavController();
        Bundle bundle = navHostFragment.getArguments();
        int dokter_id = -1;
        if (bundle != null) {
            dokter_id = bundle.getInt("dokter_id");
        }
        presenter.getDokter(dokter_id);

        binding.containerPaymentGateway.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                navController.navigate(R.id.action_payment_method);
            }
        });
        int finalDokter_id = dokter_id;
        binding.btnOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showLoading();
                presenter.checkout(finalDokter_id, "12:00", paymentCode);
            }
        });
    }

    @Override
    public void onResume() {
        super.onResume();
        getBackEntryFromPaymentMethode();
    }

    private void getBackEntryFromPaymentMethode() {
        backStackEntry = navController.getCurrentBackStackEntry();
        backStackEntry.getLifecycle().addObserver(this);
    }

    @Override
    public void onError(String msg) {
        showErrorMessage(msg);
    }

    @Override
    public void loadDetailDokter(DetailDokterResponse dokter) {
        hideLoading();

        PicassoTrustAll.getInstance(getContext()).load(dokter.image).resize(500,500).placeholder(R.drawable.image_placeholder).centerInside().into(binding.includeOrderInformation.imgDokter);
        binding.includeOrderInformation.txtDokter.setText(dokter.nama);
        binding.includeOrderInformation.txtProfession.setText(dokter.profession);
        binding.includeOrderInformation.txtLokasi.setText(dokter.instansi);
        binding.includeOrderInformation.txtJadwal.setText("13 November 2022 Pukul 12:07");

        binding.includePricingDetails.txtPrice.setText(CommonUtils.convertToRp(dokter.price));
        binding.includePricingDetails.txtDiskon.setText(CommonUtils.convertToRp(0));
        binding.includePricingDetails.txtAmount.setText(CommonUtils.convertToRp(dokter.price));

        binding.txtTotal.setText(CommonUtils.convertToRp(dokter.price));
    }

    @Override
    public void successCheckout(String msg, int invoice_id) {
        hideLoading();
        showSuccessMessage(msg);
        Intent i = new Intent(getContext(), InvoiceAct.class);
        i.putExtra("invoice_id", invoice_id);
        startActivity(i);
        getActivity().finish();
    }

    @Override
    public void onStateChanged(@NonNull LifecycleOwner source, @NonNull Lifecycle.Event event) {
        if(event == Lifecycle.Event.ON_RESUME){
            if(backStackEntry != null){
                paymentCode = backStackEntry.getSavedStateHandle().get("paymentCode");
                String paymentName = backStackEntry.getSavedStateHandle().get("paymentName");
                String paymentImage = backStackEntry.getSavedStateHandle().get("paymentImage");
                if(paymentCode != null && paymentImage != null && paymentName != null){
                    binding.textHintPaymentMethode.setVisibility(View.INVISIBLE);
                    binding.textPaymentMethode.setText(paymentName);
                    binding.textPaymentMethode.setVisibility(View.VISIBLE);
                    binding.groupPaymentMethode.setVisibility(View.VISIBLE);

                    PicassoTrustAll.getInstance(getContext()).load(paymentImage).resize(100,100).placeholder(R.drawable.image_placeholder).centerInside().into(binding.imgPaymentMethod);
                    binding.imgPaymentMethod.setVisibility(View.VISIBLE);
                    binding.btnOrder.setEnabled(true);
                }
            }

        }
    }
}