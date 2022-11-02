package com.kelompok1.mydoc.ui.dashboard;

import android.os.Bundle;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.databinding.ActivityDashboardBinding;

import androidx.appcompat.app.AppCompatActivity;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.NavigationUI;



public class MainAct extends AppCompatActivity {

    private ActivityDashboardBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityDashboardBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        BottomNavigationView navView = findViewById(R.id.nav_view);
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment_activity_dashboard);
        NavigationUI.setupWithNavController(binding.navView, navController);
    }

}