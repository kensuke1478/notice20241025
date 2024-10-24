<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('/css/edit.style.css') }}">
        <title>お知らせ更新</title>
    </head>
    <body>
        <div class="notice_footer">
            <h1>お知らせの更新</h1>
        </div>
        @foreach ($errors->all() as $error)
        <p name = "error" class="error__message text-center text-danger">{{$error}}</p>
        @endforeach
        <form action="{{ url('notice/' . $notice->information_id . '/edit') }}" method="post" novalidate>
            {{ method_field('PUT') }}
            @csrf
        <table>
            <tr>
                <th class="title"><label>お知らせタイトル</label></th>
                <td class="title"><input type="text" name = "information_title" size="100" class="title" value = "{{ old('information_title',$notice->information_title) }}"></td>
            </tr>
            <th class="kbn"><label>お知らせ区分</label></th>
            <td>
            <select name="kbn" class="form-control">
                @foreach (Config::get('information.information_kbn') as $key => $val)
                    <option value="{{ $key }}" name="information_kbn" value="{{ old('kbn') }}">{{ $val }}</option>
                @endforeach
            </select>
        </td>
            <tr>
                <th class="keisai"><label>掲載日</label></th>
                <td class="keisai"><input type="text" name = "keisai_ymd" size="100" class="keisai" value = "{{ old('keisai_ymd',$notice->keisai_ymd)}}"></td>
            </tr>
            <tr>
                <th class="kaishi"><label>適用開始年月日</label></th>
                <td class="kaishi"><input type="text" name = "enable_start_ymd" size="100" class="kaishi" value ="{{old('enable_start_ymd',$notice->enable_start_ymd)}}"></td>
            </tr>
            <tr>
                <th class="syuryou"><label>適用終了年月日</label></th>
                <td class="syuryou"><input type="text" name = "enable_end_ymd" size="100" class="syuryou" value ="{{old('enable_end_ymd',$notice->enable_end_ymd)}}"></td>
            </tr>
            <tr>
                <th class="naiyou"><label>お知らせ内容</label></th>
                <td class="naiyou"><textarea rows="10" cols="80" name = "information_naiyo" value ="{{old('information_naiyo',$notice->information_naiyo)}}"></textarea></td>
            </tr>
            <tr>
                <th class="kousin"><label>更新者コード</label></th>
                <td class="kousin"><input type="text" name = "update_user_cd" size="100" class="kousin" value ="{{old('update_user_cd',$notice->update_user_cd)}}"></td>
            </tr>
    </table>
    <button type="submit" class="btn btn-registration" value="send">更新</button>
    <button><a href="{{url('notice/')}}" class="btn btn-success">戻る</a></button>
</form>
    </body>
</html>
