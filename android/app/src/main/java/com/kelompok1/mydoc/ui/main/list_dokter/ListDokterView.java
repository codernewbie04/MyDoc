package com.kelompok1.mydoc.ui.main.list_dokter;

import com.kelompok1.mydoc.data.remote.entities.ListDokterResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

import java.util.List;

public interface ListDokterView extends BaseView {
    void dokterLoaded(List<ListDokterResponse> dokter);
}
