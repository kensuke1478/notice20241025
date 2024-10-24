<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Validator;

class noticeController extends Controller
{
    // DBクラス取得

    // お知らせ一覧・検索画面
    public function index(Request $request)
    {

        // 検索機能処理
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $query = Notice::query();
            $query
                ->where('delete_flg', 0);

            $notices = $query->paginate(1000);
        } else {
            $notices = Notice
                ::where('information_title')
                ->select()
                ->paginate(1);
        }

        return view('Notice.index', ['notices' => $notices, 'keyword' => $keyword,]);
    }

    // お知らせ新規登録処理
    public function add()
    {
        return view('notice.add');
    }

    public function create(Request $request)
    {
        // バリデーションエラー処理
        $validator = Validator::make($request->all(), [
            'information_title' => 'required|max:100',
            'keisai_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
            'enable_start_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
            'enable_end_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
        ]);
        if ($validator->fails()) {
            return redirect('/notice/add')->withInput()->withErrors($validator);
        }

        // お知らせ区分の調整
        $information_kbn = array("重要" => '1', "情報" => '2');
        $kbn = implode(',', $information_kbn);
        $kbn_date = substr($kbn, 0, -2);

        $notice = new notice;
        $notice->information_title = $request->information_title;
        $notice->information_kbn = $kbn_date;
        $notice->keisai_ymd = $request->keisai_ymd;
        $notice->enable_start_ymd = $request->enable_start_ymd;
        $notice->enable_end_ymd = $request->enable_end_ymd;
        $notice->information_naiyo = $request->information_naiyo;
        $notice->create_user_cd = $request->create_user_cd;
        $notice->update_user_cd = $request->update_user_cd;
        $notice->save();
        return redirect('/notice');
    }

    // お知らせ更新処理
    public function edit(Request $request, $information_id)
    {

        // // DB情報の確認
        // $validator = Validator::make($request->all(), [
        //     'information_id' => ['required', 'integer', 'digits_between:1,9','required', 'integer', 'digits_between:1,9', 'exists:products,information_id'],
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/notice')->withInput()->withErrors($validator);
        // }

        $notice = notice::find($information_id);
        return view('notice.edit', compact('notice'));
    }

    public function update(Request $request, notice $notice)
    {

        // バリデーションエラー処理
        $validator = Validator::make($request->all(), [
            'information_id' => '',
            'information_title' => 'required|max:100',
            'keisai_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
            'enable_start_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
            'enable_end_ymd' => 'regex:/^[a-zA-Z0-9]+$/|max:8',
        ]);
        if ($validator->fails()) {
            return redirect('/notice/edit/{information_id}')->withInput()->withErrors($validator);
        }

        // お知らせ区分の調整
        $information_kbn = array("重要" => '1', "情報" => '2');
        $kbn = implode(',', $information_kbn);
        $kbn_date = substr($kbn, 0, -2);

        $notice->information_title = $request->information_title;
        $notice->information_kbn = $kbn_date;
        $notice->keisai_ymd = $request->keisai_ymd;
        $notice->enable_start_ymd = $request->enable_start_ymd;
        $notice->enable_end_ymd = $request->enable_end_ymd;
        $notice->information_naiyo = $request->information_naiyo;
        $notice->update_user_cd = $request->update_user_cd;
        $notice->save();
        return redirect('/notice');
    }

    // お知らせ削除機能
    public function delete(Request $request, $information_id)
    {

        // DB情報の確認
        // $validator = Validator::make($request->all(), [
        //     'information_id' => ['required', 'integer', 'digits_between:1,9','required', 'integer', 'digits_between:1,9', 'exists:products,information_id'],
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/notice')->withInput()->withErrors($validator);
        // }

        $notice = notice::find($information_id);
        $notice->delete_flg = 1;
        $notice->save();
        return redirect('/notice');
    }
}
