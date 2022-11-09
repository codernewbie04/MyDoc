package com.kelompok1.mydoc.ui.booking_order.payment_method;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.navigation.NavController;
import androidx.navigation.fragment.NavHostFragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.kelompok1.mydoc.MvpApp;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.adapter.PaymentMethodAdapter;
import com.kelompok1.mydoc.data.local.model.Session;
import com.kelompok1.mydoc.data.remote.entities.PaymentMethodResponse;
import com.kelompok1.mydoc.data.remote.entities.UserResponse;
import com.kelompok1.mydoc.databinding.SheetPaymentMethodBinding;
import com.kelompok1.mydoc.ui.base.BaseBottomFragment;
import com.kelompok1.mydoc.utils.CommonUtils;

import java.util.List;

public class PaymentMethodFragment extends BaseBottomFragment<PaymentMethodPresenter> implements PaymentMethodView,OnPaymentMethodClick {
    SheetPaymentMethodBinding binding;
    private NavController navController;

    @NonNull
    @Override
    protected PaymentMethodPresenter createPresenter() {
        return new PaymentMethodPresenter(this);
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = SheetPaymentMethodBinding.inflate(inflater, container, false);
        View root = binding.getRoot();
        initView();
        return root;
    }

    @Override
    public void initView() {
        Session session = ((MvpApp) getContext().getApplicationContext()).getSession();
        UserResponse user = session.getUserData();
        if(user != null)
            binding.txtUserBalance.setText("Saldo tersedia "+CommonUtils.convertToRp(user.balance));
        binding.progressBar.setVisibility(View.VISIBLE);
        presenter.getPaymentMethod();
        NavHostFragment navHostFragment =
                (NavHostFragment) getActivity().getSupportFragmentManager().findFragmentById(R.id.nav_host_fragment);
        navController = navHostFragment.getNavController();

    }

    @Override
    public void onError(String msg) {

    }

    @Override
    public void loadPaymentGateway(List<PaymentMethodResponse> data) {
        binding.rvPaymentMethode.setHasFixedSize(true);
        binding.rvPaymentMethode.setNestedScrollingEnabled(false);
        binding.rvPaymentMethode.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        binding.rvPaymentMethode.setAdapter(new PaymentMethodAdapter(data, getContext(), this));
        binding.progressBar.setVisibility(View.INVISIBLE);
    }

    @Override
    public void onClick(PaymentMethodResponse payment) {
        navController.getPreviousBackStackEntry().getSavedStateHandle().set("paymentCode", payment.code);
        navController.getPreviousBackStackEntry().getSavedStateHandle().set("paymentName", payment.paymentName);
        navController.getPreviousBackStackEntry().getSavedStateHandle().set("paymentImage", payment.paymentImage);
        dismiss();
    }
}

