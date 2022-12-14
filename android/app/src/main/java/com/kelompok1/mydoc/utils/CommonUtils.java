package com.kelompok1.mydoc.utils;

import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.res.AssetManager;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.provider.Settings;
import android.util.Patterns;
import android.widget.DatePicker;
import android.widget.EditText;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.kelompok1.mydoc.R;
import com.kelompok1.mydoc.data.remote.entities.BaseApiResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginErrorResponse;
import com.kelompok1.mydoc.data.remote.entities.LoginResponse;

import java.io.IOException;
import java.io.InputStream;
import java.lang.annotation.Annotation;
import java.lang.reflect.Type;
import java.text.DecimalFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

import okhttp3.ResponseBody;
import retrofit2.Callback;
import retrofit2.Converter;
import retrofit2.Response;

public final class CommonUtils {

    private CommonUtils() {
        // This utility class is not publicly instantiable
    }

    @SuppressLint("all")
    public static String getDeviceId(Context context) {
        return Settings.Secure.getString(context.getContentResolver(), Settings.Secure.ANDROID_ID);
    }

    public static String getTimestamp() {
        return new SimpleDateFormat("yyyyMMdd_HHmmss", Locale.US).format(new Date());
    }

    public static boolean isEmailValid(String email) {
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    public static String loadJSONFromAsset(Context context, String jsonFileName) throws IOException {
        AssetManager manager = context.getAssets();
        InputStream is = manager.open(jsonFileName);

        int size = is.available();
        byte[] buffer = new byte[size];
        is.read(buffer);
        is.close();

        return new String(buffer, "UTF-8");
    }

    public static ProgressDialog showLoadingDialog(Context context) {
        ProgressDialog progressDialog = new ProgressDialog(context);
        progressDialog.show();
        if (progressDialog.getWindow() != null) {
            progressDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }
        progressDialog.setContentView(R.layout.progress_dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setCancelable(false);
        progressDialog.setCanceledOnTouchOutside(false);
        return progressDialog;
    }

//    public static <D,E> BaseApiResponse<D,E> parseError(Response<?> response, Type type) {
//        try {
//            Gson gson = new Gson();
//            return gson.fromJson(response.errorBody().charStream(), type);
//        }catch(Exception e) {
//            BaseApiResponse<D,E> erResponse = new BaseApiResponse<D,E>();
//            erResponse.setMessage("Error unexpected in JSON!");
//            return erResponse;
//        }
//    }

    public static BaseApiResponse parseError(Response<?> response, Type type) {
        try {
            Gson gson = new Gson();
            return gson.fromJson(response.errorBody().charStream(), type);
        }catch(Exception e) {
            BaseApiResponse erResponse =  new BaseApiResponse();
            return erResponse;
        }
    }

    public static String convertToRp(int uang)
    {
        try {
            if (uang >= 1000) {
                DecimalFormat formatter = new DecimalFormat("#,###");
                return "Rp"+formatter.format(uang).replace(",",".")+",-";
            } else {
                return "Rp"+uang+",-";
            }
        } catch (Error e){
            return "Rp0,-";
        }
    }

    public static String getFirstName(String fullname){
        if(fullname !=null)
            return fullname.split(" ", -2)[0];
        return "";
    }

    public static void showDateDialog(EditText dateField, Context mContext) throws ParseException {

        /**
         * Calendar untuk mendapatkan tanggal sekarang
         */
        String year = "2022";
        String month = "01";
        String day = "01";
        Calendar newCalendar = Calendar.getInstance();
        if(!dateField.getText().toString().isEmpty()){
            String[] date = dateField.getText().toString().split("-");
            year = date[0];
            month = date[1].replaceFirst("^0+(?!$)", "");
            day = date[2].replaceFirst("^0+(?!$)", "");

        }
        /**
         * Initiate DatePicker dialog
         */
        DatePickerDialog datePickerDialog = new DatePickerDialog(mContext, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {

                /**
                 * Method ini dipanggil saat kita selesai memilih tanggal di DatePicker
                 */

                /**
                 * Set Calendar untuk menampung tanggal yang dipilih
                 */
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);

                /**
                 * Update TextView dengan tanggal yang kita pilih
                 */
                SimpleDateFormat dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
                dateField.setText(dateFormatter.format(newDate.getTime()));
            }

        }, Integer.parseInt(year), Integer.parseInt(month)-1, Integer.parseInt(day));
        final Calendar calendar = Calendar.getInstance();
        calendar.add(Calendar.YEAR, -17);
        datePickerDialog.getDatePicker().setMaxDate(calendar.getTimeInMillis());
        datePickerDialog.show();
    }
}