package com.kelompok1.mydoc.utils;

import android.text.TextUtils;
import android.view.View;
import android.widget.EditText;

import com.google.android.material.textfield.TextInputLayout;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class FieldValidator {
    public static boolean isNull(TextInputLayout et) {
        Boolean cancel=false;
        if (TextUtils.isEmpty(et.getEditText().getText().toString().trim())) {
            et.setHelperText("Harus diisi");
            cancel = true;
        } else {
            et.setHelperText(null);
        }

        return cancel;
    }

    public static boolean isValidPassword(TextInputLayout et) {
        Boolean cancel=true;
        if (et.getEditText().getText().toString().length() < 8) {
            et.setHelperText("Password minimum 8 karakter");
            cancel = false;
        } else {
            et.setHelperText(null);
        }
        return cancel;
    }

    public static boolean invalidEmail(TextInputLayout email){
        Boolean cancel=false;
        if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email.getEditText().getText().toString().trim()).matches()) {
            email.setHelperText("Email tidak valid");
            cancel = true;
        } else {
            email.setHelperText(null);
        }
        return cancel;
    }

    public static boolean isSamePassword(TextInputLayout et1, TextInputLayout et2){
        Boolean cancel=true;
        if (!et1.getEditText().getText().toString().equals(et2.getEditText().getText().toString())) {
            et2.setHelperText("Password tidak sama!");
            cancel = false;
        } else {
            et1.setHelperText(null);
            et2.setHelperText(null);
        }
        return cancel;
    }
}