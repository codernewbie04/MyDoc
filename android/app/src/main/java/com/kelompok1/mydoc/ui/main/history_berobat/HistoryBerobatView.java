package com.kelompok1.mydoc.ui.main.history_berobat;

import com.kelompok1.mydoc.data.remote.entities.HistoryResponse;
import com.kelompok1.mydoc.ui.base.BaseView;

import java.util.List;

public interface HistoryBerobatView extends BaseView {
    void loadHistoryBerobat(List<HistoryResponse> data);
}
